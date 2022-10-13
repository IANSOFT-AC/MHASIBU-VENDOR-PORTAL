<?php

namespace app\controllers;

use app\models\SupplierPartnerDetails;
use app\models\VendorCard;
use Yii;
use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\Controller;
use frontend\models\Leave;
use yii\web\Response;
use app\models\MemberApplicationCard;


class DirectorsController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup', 'index'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'index'],
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
            'contentNegotiator' => [
                'class' => ContentNegotiator::class,
                'only' => ['getsignatories'],
                'formatParam' => '_format',
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                    //'application/xml' => Response::FORMAT_XML,
                ],
            ]
        ];
    }

    public function beforeAction($action)
    {

        $ExceptedActions = [
            'add-line', 'gender', 'countries'
        ];

        if (in_array($action->id, $ExceptedActions)) {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }


    public function actionIndex()
    {
        $service = Yii::$app->params['ServiceName']['SupplierPartnerDetails'];
        $filter = [
            'Vendor_No' => Yii::$app->user->identity->VendorId,
        ];
        $signatories = Yii::$app->navhelper->getData($service, $filter);

        return $this->render('index', [
            'data' => $signatories
        ]);
    }

    public function getCountries()
    {
        $service = Yii::$app->params['ServiceName']['Countries'];
        $res = [];
        $Countries = \Yii::$app->navhelper->getData($service);
        foreach ($Countries as $Country) {
            if (!empty($Country->Code))
                $res[] = [
                    'Code' => $Country->Code,
                    'Name' => $Country->Name
                ];
        }

        return $res;
    }



    public function ApplicantDetails($key)
    {
        $model = new VendorCard();
        $service = Yii::$app->params['ServiceName']['VendorCard'];
        $memberApplication = Yii::$app->navhelper->readByKey($service, $key);
        return $model = Yii::$app->navhelper->loadmodel($memberApplication, $model);
    }


    public function ApplicantDetailWithDocNum($Docnum)
    {
        $model = new VendorCard();
        $service = Yii::$app->params['ServiceName']['VendorCard'];
        $filter = [
            'No' => $Docnum
        ];
        $memberApplication = Yii::$app->navhelper->getData($service, $filter);
        return $model = Yii::$app->navhelper->loadmodel($memberApplication[0], $model);
    }



    public function actionCreate()
    {

        $model = new SupplierPartnerDetails();
        $service = Yii::$app->params['ServiceName']['SupplierPartnerDetails'];

        $model->Vendor_No = Yii::$app->user->identity->vendorNo;
        $model->Partner_ID_No = substr(Yii::$app->security->generateRandomString(9), 0, 9);
        //$model->Supplier_No = $ApplicantionData->No;

        // Make Initial Request
        $result = Yii::$app->navhelper->postData($service, $model);
        if (is_object($result)) {
            Yii::$app->navhelper->loadmodel($result, $model);
        } else {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['note' => '<div class="alert alert-danger">Error : ' . $result . '</div>'];
        }

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('create', [
                'model' => $model,
                'Countries' => $this->getCountries(),
            ]);
        }
    }

    public function getMembers()
    {
        $service = Yii::$app->params['ServiceName']['Members'];
        $res = [];
        $Members = \Yii::$app->navhelper->getData($service);
        foreach ($Members as $Member) {
            if (!empty($Member->No))
                $res[] = [
                    'Code' => $Member->No,
                    'Name' => $Member->Name
                ];
        }

        return $res;
    }

    public function actionUpdate()
    {
        $service = Yii::$app->params['ServiceName']['SupplierPartnerDetails'];
        $model = new SupplierPartnerDetails();

        $result = Yii::$app->navhelper->readByKey($service, urldecode(Yii::$app->request->get('Key')));

        if (is_object($result)) {
            Yii::$app->navhelper->loadmodel($result, $model);
        } else {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['note' => '<div class="alert alert-danger">Error : ' . $result . '</div>'];
        }


        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('update', [
                'model' => $model,
                'Countries' => $this->getCountries(),
            ]);
        }
    }

    public function actionDelete()
    {
        $service = Yii::$app->params['ServiceName']['SupplierPartnerDetails'];
        $result = Yii::$app->navhelper->deleteData($service, Yii::$app->request->get('Key'));
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (!is_string($result)) {
            //return ['note' => '<div class="alert alert-success">Record Purged Successfully</div>'];
            Yii::$app->session->setFlash("success", 'Record Purged Successfully', true);
        } else {
            Yii::$app->session->setFlash("success", 'Record Purged Successfully', true);
            // return ['note' => '<div class="alert alert-danger">Error Purging Record: ' . $result . '</div>'];
        }
        return;
    }



    public function actionCommit()
    {
        $commitService = Yii::$app->request->post('service');
        $key = Yii::$app->request->post('key');
        $name = Yii::$app->request->post('name');
        $value = Yii::$app->request->post('value');

        $service = Yii::$app->params['ServiceName'][$commitService];
        $request = Yii::$app->navhelper->readByKey($service, $key);
        $data = [];
        if (is_object($request)) {
            $data = [
                'Key' => $request->Key,
                $name => $value
            ];
        } else {
            Yii::$app->response->format = \yii\web\response::FORMAT_JSON;
            return ['error' => $request];
        }

        $result = Yii::$app->navhelper->updateData($service, $data);
        Yii::$app->response->format = \yii\web\response::FORMAT_JSON;
        return $result;
    }


    public function actionGetsignatories($AppNo)
    {
        $service = Yii::$app->params['ServiceName']['SupplierPartnerDetails'];
        $filter = [
            'Vendor_No' => Yii::$app->user->identity->VendorId,
        ];
        $signatories = Yii::$app->navhelper->getData($service, $filter);

        $result = [];
        $count = 0;

        if (!is_object($signatories)) {
            foreach ($signatories as $kin) {

                if (!property_exists($kin, 'Key')) { //Useless KIn this One
                    continue;
                }
                ++$count;
                $link = $updateLink =  '';
                $data = $this->ApplicantDetailWithDocNum($kin->Vendor_No);
                $updateLink = Html::a('<i class="fas fa-edit"></i>', ['update', 'Key' => urlencode($kin->Key)], ['class' => 'update btn btn-info btn-md', 'title' => 'Update Record.']);
                $deletelink = Html::a('<i class="fas fa-trash"></i>', ['delete', 'Key' => urlencode($kin->Key)], ['class' => 'mx-2 btn btn-danger btn-md delete', 'title' => 'Purge a record.']);

                $result['data'][] = [
                    'index' => $count,
                    'Partner_Name' => !empty($kin->Partner_Name) ? $kin->Partner_Name : '',
                    'Partner_ID_No' => !empty($kin->Partner_ID_No) ? $kin->Partner_ID_No : '',
                    'Partner_Occupation' => !empty($kin->Partner_Occupation) ? $kin->Partner_Occupation : '',
                    'PIN' => !empty($kin->PIN) ? $kin->PIN : '',
                    'Mobile_No__x002B_254' => !empty($kin->Mobile_No__x002B_254) ? $kin->Mobile_No__x002B_254 : '',
                    'action' => $updateLink . $deletelink
                ];
            }
        }



        return $result;
    }

    public function actionGender()
    {
        $data = [
            '_blank_' => '_blank_',
            'Female' => 'Female',
            'Male' => 'Male'
        ];
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $data;
    }

    public function actionCountries()
    {
        $data = Yii::$app->navhelper->dropdown('Countries', 'Code', 'Name');
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $data;
    }

    public function getReligion()
    {
        $service = Yii::$app->params['ServiceName']['Religion'];
        $filter = [
            'Type' => 'Religion'
        ];
        $religion = \Yii::$app->navhelper->getData($service, $filter);
        return $religion;
    }

    /** Updates a single field */
    public function actionSetfield($field)
    {
        $service = 'SupplierPartnerDetails';
        $value = Yii::$app->request->post('fieldValue');

        $result = Yii::$app->navhelper->Commit($service, [$field => $value], Yii::$app->request->post('Key'));
        Yii::$app->response->format = \yii\web\response::FORMAT_JSON;
        return $result;
    }

    public function actionAddLine()
    {

        $data = file_get_contents('php://input');
        $params = json_decode($data);


        //Yii::$app->recruitment->printrr($params);
        $service = Yii::$app->params['ServiceName'][$params->Service];
        $data = [
            'Vendor_No' => $params->No,
        ];

        // Insert Record

        $result = Yii::$app->navhelper->postData($service, $data);

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (is_object($result)) {
            return [
                'note' => 'Record Created Successfully.',
                'result' => $result
            ];
        } else {
            return ['note' => $result];
        }
    }


    public function actionDeleteLine($Service, $Key)
    {
        $service = Yii::$app->params['ServiceName'][$Service];
        $result = Yii::$app->navhelper->deleteData($service, Yii::$app->request->get('Key'));
        Yii::$app->session->setFlash('success', 'Record Deleted Successfully.', true);
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (!is_string($result)) {
            return [
                'note' => 'Record Deleted Successfully.',
                'result' => $result
            ];
        } else {
            return ['note' => $result];
        }
    }
}
