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


class BankAccountController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup','index'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                     [
                        'actions' => ['logout','index'],
                        'allow' => true,
                        //'roles' => ['@'],
                        'matchCallback' => function($rule,$action){
                            return (Yii::$app->session->has('HRUSER') || !Yii::$app->user->isGuest);
                        },
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
            'contentNegotiator' =>[
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


    public function actionIndex(){
        $model = new SupplierPartnerDetails();
       
        return $this->render('index');

    }

    public function getCountries(){
        $service = Yii::$app->params['ServiceName']['Countries'];
        $res = [];
        $Countries = \Yii::$app->navhelper->getData($service);
        foreach($Countries as $Country){
            if(!empty($Country->Code))
            $res[] = [
                'Code' => $Country->Code,
                'Name' => $Country->Name
            ];
        }

        return $res;
    }
    

 
    public function ApplicantDetails($key){
        $model = new VendorCard();
        $service = Yii::$app->params['ServiceName']['VendorCard'];
        $memberApplication = Yii::$app->navhelper->readByKey($service, $key);
       return $model = Yii::$app->navhelper->loadmodel($memberApplication,$model);
    }


    public function ApplicantDetailWithDocNum($Docnum){
        $model = new VendorCard();
        $service = Yii::$app->params['ServiceName']['VendorCard'];
        $filter = [
            'No'=>$Docnum
        ];
        $memberApplication = Yii::$app->navhelper->getData($service,$filter);
       return $model = Yii::$app->navhelper->loadmodel($memberApplication[0],$model);
    }



    public function actionCreate(){

        $model = new BankAccount();
        $service = Yii::$app->params['ServiceName']['SupplierBankAccounts'];
        $model->Supplier_No = Yii::$app->user->identity->vendorNo;
        $model->Code = $this->getRandomCode();     
    
       // Make Initial Request
       $result = Yii::$app->navhelper->postData($service, $model);
       if(is_object($result))
       {
           Yii::$app->navhelper->loadmodel($result, $model);
       }else{
           Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
           echo ('<div class="alert alert-danger">Error : '.$result.'</div>');
           return '';

       }

        if(Yii::$app->request->isAjax){
            return $this->renderAjax('create', [
                'model' => $model,
                'banks'=> Yii::$app->navhelper->dropdown('KenyaBanks','Bank_Code','Bank_Name'),
            ]);
        }
    }

    public function getRandomCode()
    {
        $codes = Yii::$app->navhelper->dropdown('KenyaBanks','Bank_Code','Bank_Name');
        $keys = array_keys($codes);
        shuffle($keys);
        return $keys[0];
    }

    public function actionUpdate(){
        $service = Yii::$app->params['ServiceName']['SupplierBankAccounts'];
        $model = new BankAccount();
       
        $result = Yii::$app->navhelper->readByKey($service, urldecode(Yii::$app->request->get('Key')));
        
        if(is_object($result)) {
            Yii::$app->navhelper->loadmodel($result, $model);
        }else{
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            echo '<div class="alert alert-danger">Error : '.$result.'</div>';
        }


        if(Yii::$app->request->isAjax){
            return $this->renderAjax('update', [
                'model' => $model,
                'banks'=> Yii::$app->navhelper->dropdown('KenyaBanks','Bank_Code','Bank_Name')
            ]);
        }

 
    }

    public function actionDelete(){
        $service = Yii::$app->params['ServiceName']['SupplierBankAccounts'];
        $result = Yii::$app->navhelper->deleteData($service,urldecode(Yii::$app->request->get('Key')));
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if(!is_string($result)){
            return ['note' => '<div class="alert alert-success">Record Purged Successfully</div>'];
        }else{
            return ['note' => '<div class="alert alert-danger">Error Purging Record: '.$result.'</div>' ];
        }
    }


    public function actionView($ApplicationNo){
        $service = Yii::$app->params['ServiceName']['leaveApplicationCard'];
        $leaveTypes = $this->getLeaveTypes();
        $employees = $this->getEmployees();

        $filter = [
            'Application_No' => $ApplicationNo
        ];

        $leave = Yii::$app->navhelper->getData($service, $filter);

        //load nav result to model
        $leaveModel = new AccountSignatoriesList();
        $model = $this->loadtomodel($leave[0],$leaveModel);


        return $this->render('view',[
            'model' => $model,
            'leaveTypes' => ArrayHelper::map($leaveTypes,'Code','Description'),
            'relievers' => ArrayHelper::map($employees,'No','Full_Name'),
        ]);
    }



    public function actionList()
    {
        $service = Yii::$app->params['ServiceName']['SupplierBankAccounts'];
        $filter = [
            'Supplier_No' => Yii::$app->user->identity->vendorNo,
        ];
        $results = Yii::$app->navhelper->getData($service,$filter);

        $result = [];
        $count = 0;
      
        if(is_array($results)){
            foreach($results as $kin){

                if(empty($kin->Name) && empty($kin->Bank_Account_No) ){ 
                    continue;
                }
                ++$count;
                $link = $updateLink =  '';
               
               
                $updateLink = Html::a('<i class="fas fa-edit"></i>',['update','Key'=> urlencode($kin->Key) ],['class'=>'update btn btn-info btn-md','title' => 'Update Record.']);
                $deletelink = Html::a('<i class="fas fa-trash"></i>',['delete','Key'=> urlencode($kin->Key) ],['class'=>'mx-2 btn btn-danger btn-md delete', 'title' => 'Purge a record.']);
               

                $result['data'][] = [
                    'index' => $count,
                    'Code' => !empty($kin->Code)?$kin->Code:'',
                    'Name' => !empty($kin->Name)?$kin->Name:'',
                    'Bank_Account_No' => !empty($kin->Bank_Account_No)?$kin->Bank_Account_No:'',
                    'SWIFT_Code' => !empty($kin->SWIFT_Code)?$kin->SWIFT_Code:'',
                    'action' => $updateLink.$deletelink
                ];
            }
        
        }
           
      

        return $result;
    }

    public function getReligion(){
        $service = Yii::$app->params['ServiceName']['Religion'];
        $filter = [
            'Type' => 'Religion'
        ];
        $religion = \Yii::$app->navhelper->getData($service, $filter);
        return $religion;
    }

     /** Updates a single field */
     public function actionSetfield($field){
        $service = 'SupplierBankAccounts';
        $value = Yii::$app->request->post('fieldValue');
       
        $result = Yii::$app->navhelper->Commit($service,[$field => $value],Yii::$app->request->post('Key'));
        Yii::$app->response->format = \yii\web\response::FORMAT_JSON;
        return $result;
          
    }
}