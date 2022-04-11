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
                'only' => ['logout', 'index', ],
                'rules' => [
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

    public function beforeAction($action){
        if(Yii::$app->user->isGuest){
            $this->layout = 'guest';
            $this->goHome();
        }
        if (!parent::beforeAction($action)) {
            return false;
        }
        return true; // or false to not run the action
    }


    public function actionIndex(){
        $model = new VendorCard();
        $service = Yii::$app->params['ServiceName']['VendorCard'];
        

        if($model->hasProfile())
        {
            $this->redirect(['company-profile/view']);
        }

        Yii::$app->user->logout();

        return $this->goHome();

        return $this->render('index', [
            'model'=>$model
        ]);
    }

    /*Created Supplier Profle*/
   public function actionCreate(){

    $model = new VendorCard();
    $model->PortalId = Yii::$app->user->identity->id;
    $model->No = Yii::$app->user->identity->vendorNo;

       
    $service = Yii::$app->params['ServiceName']['VendorCard'];

     return $this->render('create',[
         'model' => $model,
         'towns' => Yii::$app->navhelper->dropdown('PostalCodes','Code','City'),
         'countries' => Yii::$app->navhelper->dropdown('Countries','Code','Name'),
         'scategories' => Yii::$app->navhelper->dropdown('SupplierCategory','Category_Code','Description'),
         'locations' =>  [],
         'ShipmentMethods' => [],
         'paymentTerms' =>Yii::$app->navhelper->dropdown('PaymentTerms','Code','Description'),
         'paymentMethods' => Yii::$app->navhelper->dropdown('PaymentMethods','Code','Description')
        
     ]);
 }

    public function actionUpdate(){
        $model = new VendorCard();
        $service = Yii::$app->params['ServiceName']['VendorCard'];

        // Check for vendorID as well as account verification hook validation

        if(!Yii::$app->user->identity->vendorID)
        {
            Yii::$app->session->setFlash('error', 'Kindly Check your email to validate your account in order to proceed, thank you.');
            return $this->redirect(['site/index']);

        }

        $data = Yii::$app->navhelper->findOne($service,'','No', Yii::$app->user->identity->vendorNo);
        Yii::$app->navhelper->loadmodel($data, $model);
        return $this->render('update', [
            'model' => $model,
            'towns' => Yii::$app->navhelper->dropdown('PostalCodes','Code','City'),
            'countries' => Yii::$app->navhelper->dropdown('Countries','Code','Name'),
            'scategories' => Yii::$app->navhelper->dropdown('SupplierCategory','Category_Code','Description'),
            'locations' =>  [],
            'ShipmentMethods' => [],
            'paymentTerms' => Yii::$app->navhelper->dropdown('PaymentTerms','Code','Description'),
            'paymentMethods' => Yii::$app->navhelper->dropdown('PaymentMethods','Code','Description')
        ]);
    }

  
    public function actionView(){
        $model = new VendorCard();
        $service = Yii::$app->params['ServiceName']['VendorCard'];
        $data = Yii::$app->navhelper->findOne($service,'','No', Yii::$app->user->identity->vendorNo);
        Yii::$app->navhelper->loadmodel($data, $model);

        return $this->render('view', [
            'model' => $model,
            'towns' => Yii::$app->navhelper->dropdown('PostalCodes','Code','City'),
            'countries' => Yii::$app->navhelper->dropdown('Countries','Code','Name'),
            'scategories' => Yii::$app->navhelper->dropdown('SupplierCategory','Category_Code','Description'),
            'locations' =>  [],
            'ShipmentMethods' => [],
            'paymentTerms' => Yii::$app->navhelper->dropdown('PaymentTerms','Code','Description'),
            'paymentMethods' => Yii::$app->navhelper->dropdown('PaymentMethods','Code','Description')
        ]);
    }

    public function actionSubmit(){
        $model = new VendorCard();
        $service = Yii::$app->params['ServiceName']['VendorCard'];
        $data = Yii::$app->navhelper->findOne($service,'','No', Yii::$app->user->identity->vendorNo);
        Yii::$app->navhelper->loadmodel($data, $model);

        return $this->render('submit', ['model' => $model]);
    }

    public function actionSubmitProfile()
    {
        $service =  Yii::$app->params['ServiceName']['PortalFactory'];
        $payload = ['applicationNo' => Yii::$app->user->identity->vendorNo];

        $result = Yii::$app->navhelper->codeunit($service,$payload,'IanSubmitSupplierApp');

        if(!is_string($result))
        {
            Yii::$app->session->setFlash('success','Congratulations, profile submitted Successfully.', true);
            $this->redirect(['view']);
        }else{
            Yii::$app->session->setFlash('error', $result, true);
            $this->redirect(['update']);
        }
    }


     /** Updates a single field */
     public function actionSetfield($field){
        $service = 'VendorCard';
        $value = Yii::$app->request->post('fieldValue');
       
        $result = Yii::$app->navhelper->Commit($service,[$field => $value],Yii::$app->request->post('Key'));
        Yii::$app->response->format = \yii\web\response::FORMAT_JSON;
        return $result;
          
    }

   


   

}
