<?php

namespace app\controllers;

use app\models\BankAccount;
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
use app\models\Quotation;
use app\models\Supplier;

class QuotationsController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup', 'index','quote'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'index','quote'],
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
                'only' => ['list'],
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
            'add-line', 'banks', 'bank-branch'
        ];

        if (in_array($action->id, $ExceptedActions)) {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }


    public function actionIndex()
    {
        $service = Yii::$app->params['ServiceName']['SupplierBankAccounts'];
        $filter = [
            'Supplier_No' => Yii::$app->user->identity->VendorId,
        ];
        $data = Yii::$app->navhelper->getData($service, $filter);

        return $this->render('index', [
            'data' => $data,
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

        $model = new BankAccount();
        $service = Yii::$app->params['ServiceName']['SupplierBankAccounts'];
        $model->Supplier_No = Yii::$app->user->identity->vendorNo;
        $model->Code = $this->getRandomCode();

        // Make Initial Request
        $result = Yii::$app->navhelper->postData($service, $model);
        if (is_object($result)) {
            Yii::$app->navhelper->loadmodel($result, $model);
        } else {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            echo ('<div class="alert alert-danger">Error : ' . $result . '</div>');
            return '';
        }

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('create', [
                'model' => $model,
                'banks' => Yii::$app->navhelper->dropdown('KenyaBanks', 'Bank_Code', 'Bank_Name'),
            ]);
        }
    }

    public function getRandomCode()
    {
        $codes = Yii::$app->navhelper->dropdown('KenyaBanks', 'Bank_Code', 'Bank_Name');
        $keys = array_keys($codes);
        shuffle($keys);
        return $keys[0];
    }

    public function actionUpdate()
    {
        $service = Yii::$app->params['ServiceName']['SupplierBankAccounts'];
        $model = new BankAccount();

        $result = Yii::$app->navhelper->readByKey($service, urldecode(Yii::$app->request->get('Key')));

        if (is_object($result)) {
            Yii::$app->navhelper->loadmodel($result, $model);
        } else {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            echo '<div class="alert alert-danger">Error : ' . $result . '</div>';
        }


        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('update', [
                'model' => $model,
                'banks' => Yii::$app->navhelper->dropdown('KenyaBanks', 'Bank_Code', 'Bank_Name')
            ]);
        }
    }

    public function actionDelete()
    {
        $service = Yii::$app->params['ServiceName']['SupplierBankAccounts'];
        $result = Yii::$app->navhelper->deleteData($service, Yii::$app->request->get('Key'));
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (!is_string($result)) {

            return Yii::$app->session->setFlash("success", 'Record Purged Successfully', true);
        } else {
            return Yii::$app->session->setFlash("success", 'Record Purged Successfully', true);
        }
    }


    public function actionView($No="",$Key="")
    {
        $service = Yii::$app->params['ServiceName']['quotationCard'];

        $document = Yii::$app->navhelper->readByKey($service, $Key);

        //load nav result to model

        $model = new Quotation();
        if(is_object($model) && property_exists($document, 'Key')){
            Yii::$app->navhelper->loadmodel($document, $model);
        }

        // Yii::$app->recruitment->printrr($model);
        return $this->render('view', [
            'model' => $model,
            'document' => $document
        ]);
    }



    public function actionList()
    {
        $service = Yii::$app->params['ServiceName']['advertisedQuotationsList'];
        $filter = [
            //'Vendor_No' => Supplier::VendorNo(),
        ];
        $results = Yii::$app->navhelper->getData($service, $filter);

        $result = [];
        $count = 0;

        if (is_array($results)) {
            foreach ($results as $kin) {

                if (empty($kin->Key)) {
                    continue;
                }
                ++$count;
                $link = $updateLink = $view ='';

                $viewLink = Html::a('<i class="fas fa-eye"></i>', ['view', 'Key' => $kin->Key], ['class' => 'update btn btn-info btn-md', 'title' => 'Update Record.']);
                $RespondLink = Supplier::IsBidder($kin->No) ? Html::a('<i class="fas fa-coins"></i>', ['quote', 'quoteNo' => $kin->No], ['class' => 'btn btn-outline-primary mx-2 btn-md', 'title' => 'Quote for Individual Items.']):'';
                $deletelink = Html::a('<i class="fas fa-trash"></i>', ['delete', 'Key' => $kin->Key], ['class' => 'mx-2 btn btn-danger btn-md delete', 'title' => 'Purge a record.']);


                $result['data'][] = [
                    'No' => $kin->No,
                    'Title' => !empty($kin->Title) ? $kin->Title : '',
                    'Status' => !empty($kin->Status) ? $kin->Status : '',
                    'action' => $viewLink.$RespondLink
                ];
            }
        }



        return $result;
    }

    // Vendor Quoted Amount List

    public function actionQuote($quoteNo)
    {
        $service = Yii::$app->params['ServiceName']['VendorQuotedAmount'];
        $filter = [
            'Quote_No' =>  $quoteNo,
            'Vendor_No' => Supplier::VendorNo()
        ];  

         //Yii::$app->recruitment->printrr($filter);
         $result = Yii::$app->navhelper->getData($service, $filter);

         return $this->render('quote', [
            'data' => $result,
            'title' => 'Quote Per Item'
         ]);
    }

    // Submit the quotes

    public function actionSubmit($quoteNo, $vendorNo)
    {
        $service = Yii::$app->params['ServiceName']['PortalFactory'];

        $data = [
            'quoteNo' => $quoteNo,
            'vendorNo' => $vendorNo
        ];


        $result = Yii::$app->navhelper->codeunit($service, $data, 'IanSubmitVendorBids');

        if (($result)) {
            Yii::$app->session->setFlash('success', 'Quote Submitted Successfully.', true);
            return $this->redirect(['index']);
        } else {

            Yii::$app->session->setFlash('error', 'Error submitting quote  : ' . $result);
            return $this->redirect(['index']);
        }
    }


    public function actionBanks()
    {
        $data = Yii::$app->navhelper->dropdown('KenyaBanks', 'Bank_Code', 'Bank_Name');
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $data;
    }

    public function actionBankBranch()
    {
        $data = file_get_contents('php://input');
        $params = json_decode($data);

        $filter = (array)$params;
        $data = Yii::$app->navhelper->dropdown('BankBranches', 'Branch_Code', 'Branch_Name', $filter, ['Branch_Code', 'Bank_Name']);
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $data;
    }


    // VALUE COMMITMENT FUNCTIONS

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
        $service = Yii::$app->params['ServiceName'][$params->Service];
        $data = [
            'Supplier_No' => $params->No,
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
