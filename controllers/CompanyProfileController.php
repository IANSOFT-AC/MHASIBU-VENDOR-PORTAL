<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\RegisterForm;
use app\models\ResetPasswordForm;
use app\models\Supplier;
use app\models\User;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use app\models\VerifyEmailForm;
use app\models\VendorCard;


class CompanyProfileController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'index',],
                'rules' => [
                    [
                        'actions' => ['signup', 'setfield'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'index',],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }




    public function actionIndex()
    {
        $model = new VendorCard();
        $service = Yii::$app->params['ServiceName']['VendorCard'];


        if ($model->hasProfile()) {
            $this->redirect(['company-profile/view']);
        }

        Yii::$app->user->logout();

        return $this->goHome();

        return $this->render('index', [
            'model' => $model
        ]);
    }

    /*Created Supplier Profle*/
    public function actionCreate()
    {

        $model = new VendorCard();
        $model->PortalId = Yii::$app->user->identity->id;
        $model->No = Yii::$app->user->identity->VendorNo;


        $service = Yii::$app->params['ServiceName']['VendorCard'];

        // Make initial request
        $request = Yii::$app->navhelper->postData($service, $model);


        if (is_object($request) && property_exists($request, 'Key')) {

            // Update UserTable with SUpplier No

            $user = Supplier::findOne(['id' => Yii::$app->user->identity->id]);
            if ($user) {
                $user->VendorId = $request->No;
                if ($user->save()) {
                    return $this->redirect(['update']);
                }
            }

            if (Yii::$app->user->identity->VendorId) {
                return $this->redirect(['update']);
            }





            Yii::$app->navhelper->loadmodel($request, $model);

            return $this->render('create', [
                'model' => $model,
                'towns' => Yii::$app->navhelper->dropdown('PostalCodes', 'Code', 'City'),
                'countries' => Yii::$app->navhelper->dropdown('Countries', 'Code', 'Name'),
                'scategories' => Yii::$app->navhelper->dropdown('SupplierCategory', 'Category_Code', 'Description'),
                'locations' =>  [],
                'ShipmentMethods' => [],
                'paymentTerms' => Yii::$app->navhelper->dropdown('PaymentTerms', 'Code', 'Description'),
                'paymentMethods' => Yii::$app->navhelper->dropdown('PaymentMethods', 'Code', 'Description')

            ]);
        }

        Yii::$app->recruitment->printrr($request);
    }

    public function actionUpdate()
    {
        $model = new VendorCard();
        $service = Yii::$app->params['ServiceName']['VendorCard'];

        // Check for vendorId as well as account verification hook validation
        //Yii::$app->recruitment->printrr(Yii::$app->user->identity->VendorId);
        $data = Yii::$app->navhelper->findOne($service, '', ['No' =>  Yii::$app->user->identity->VendorId]);
        Yii::$app->navhelper->loadmodel($data, $model);
        return $this->render('update', [
            'model' => $model,
            'towns' => Yii::$app->navhelper->dropdown('PostalCodes', 'Code', 'City'),
            'countries' => Yii::$app->navhelper->dropdown('Countries', 'Code', 'Name'),
            'scategories' => Yii::$app->navhelper->dropdown('SupplierCategory', 'Category_Code', 'Description'),
            'locations' =>  [],
            'ShipmentMethods' => [],
            'paymentTerms' => Yii::$app->navhelper->dropdown('PaymentTerms', 'Code', 'Description'),
            'paymentMethods' => Yii::$app->navhelper->dropdown('PaymentMethods', 'Code', 'Description')
        ]);
    }


    public function actionView()
    {
        $model = new VendorCard();
        $service = Yii::$app->params['ServiceName']['VendorCard'];
        $data = Yii::$app->navhelper->findOne($service, '', 'No', Yii::$app->user->identity->vendorNo);
        Yii::$app->navhelper->loadmodel($data, $model);

        return $this->render('view', [
            'model' => $model,
            'towns' => Yii::$app->navhelper->dropdown('PostalCodes', 'Code', 'City'),
            'countries' => Yii::$app->navhelper->dropdown('Countries', 'Code', 'Name'),
            'scategories' => Yii::$app->navhelper->dropdown('SupplierCategory', 'Category_Code', 'Description'),
            'locations' =>  [],
            'ShipmentMethods' => [],
            'paymentTerms' => Yii::$app->navhelper->dropdown('PaymentTerms', 'Code', 'Description'),
            'paymentMethods' => Yii::$app->navhelper->dropdown('PaymentMethods', 'Code', 'Description')
        ]);
    }

    public function actionSubmit()
    {
        $model = new VendorCard();
        $service = Yii::$app->params['ServiceName']['VendorCard'];
        $data = Yii::$app->navhelper->findOne($service, '', 'No', Yii::$app->user->identity->vendorNo);
        Yii::$app->navhelper->loadmodel($data, $model);

        return $this->render('submit', ['model' => $model]);
    }

    public function actionSubmitProfile()
    {
        $service =  Yii::$app->params['ServiceName']['PortalFactory'];
        $payload = ['applicationNo' => Yii::$app->user->identity->vendorNo];

        $result = Yii::$app->navhelper->codeunit($service, $payload, 'IanSubmitSupplierApp');

        if (!is_string($result)) {
            Yii::$app->session->setFlash('success', 'Congratulations, profile submitted Successfully.', true);
            $this->redirect(['view']);
        } else {
            Yii::$app->session->setFlash('error', $result, true);
            $this->redirect(['update']);
        }
    }


    public function actionSetfield($field)
    {

        $service = Yii::$app->request->post('service') !== 'VendorCard'  ? Yii::$app->request->post('service') : 'VendorCard';
        $value = Yii::$app->request->post('fieldValue');

        $result = Yii::$app->navhelper->Commit($service, [$field => $value], Yii::$app->request->post('Key'));
        //Yii::$app->recruitment->printrr($result);
        Yii::$app->response->format = \yii\web\response::FORMAT_JSON;
        return $result;
    }
}
