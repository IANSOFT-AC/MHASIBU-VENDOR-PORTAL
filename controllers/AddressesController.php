<?php

namespace app\controllers;

use app\models\Addresses;
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


class AddressesController extends Controller
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
                        //'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
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
            'add-line', 'countries', 'postalcodes'
        ];

        if (in_array($action->id, $ExceptedActions)) {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }


    public function actionIndex()
    {
        $service = Yii::$app->params['ServiceName']['SupplierAdditionalAddress'];
        $filter = [
            'Supplier_No' => Yii::$app->user->identity->VendorId,
        ];
        $results = Yii::$app->navhelper->getData($service, $filter);

        return $this->render('index', [
            'data' => $results
        ]);
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

        $model = new Addresses();
        $service = Yii::$app->params['ServiceName']['SupplierAdditionalAddress'];
        $model->Supplier_No = Yii::$app->user->identity->vendorNo;
        $model->Post_Code = $this->getRandomPostalCode();

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
                'postalCodes' => Yii::$app->navhelper->dropdown('PostalCodes', 'Code', 'City'),
            ]);
        }
    }

    public function getRandomPostalCode()
    {
        $codes = Yii::$app->navhelper->dropdown('PostalCodes', 'Code', 'City');
        $keys = array_keys($codes);
        shuffle($keys);
        return $keys[0];
    }

    public function actionUpdate()
    {
        $service = Yii::$app->params['ServiceName']['SupplierAdditionalAddress'];
        $model = new Addresses();

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
                'postalCodes' => Yii::$app->navhelper->dropdown('PostalCodes', 'Code', 'City'),
            ]);
        }
    }

    public function actionDelete()
    {
        $service = Yii::$app->params['ServiceName']['SupplierAdditionalAddress'];
        $result = Yii::$app->navhelper->deleteData($service, urldecode(Yii::$app->request->get('Key')));
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (!is_string($result)) {
            return ['note' => '<div class="alert alert-success">Record Purged Successfully</div>'];
        } else {
            return ['note' => '<div class="alert alert-danger">Error Purging Record: ' . $result . '</div>'];
        }
    }




    public function actionList()
    {
        $service = Yii::$app->params['ServiceName']['SupplierAdditionalAddress'];
        $filter = [
            'Supplier_No' => Yii::$app->user->identity->vendorNo,
        ];
        $results = Yii::$app->navhelper->getData($service, $filter);

        $result = [];
        $count = 0;

        if (is_array($results)) {
            foreach ($results as $kin) {

                if (empty($kin->Address) && empty($kin->Post_Code)) {
                    continue;
                }
                ++$count;
                $link = $updateLink =  '';


                $updateLink = Html::a('<i class="fas fa-edit"></i>', ['update', 'Key' => urlencode($kin->Key)], ['class' => 'update btn btn-info btn-md', 'title' => 'Update Record.']);
                $deletelink = Html::a('<i class="fas fa-trash"></i>', ['delete', 'Key' => urlencode($kin->Key)], ['class' => 'mx-2 btn btn-danger btn-md delete', 'title' => 'Purge a record.']);


                $result['data'][] = [
                    'index' => $count,
                    'Address' => !empty($kin->Address) ? $kin->Address : '',
                    'Post_Code' => !empty($kin->Post_Code) ? $kin->Post_Code : '',
                    'City' => !empty($kin->City) ? $kin->City : '',
                    'Country_Code' => !empty($kin->Country_Code) ? $kin->Country_Code : '',
                    'Telephone_No' => !empty($kin->Telephone_No) ? $kin->Telephone_No : '',
                    'E_mail' => !empty($kin->E_mail) ? $kin->E_mail : '',
                    'action' => $updateLink . $deletelink
                ];
            }
        }



        return $result;
    }

    public function actionCountries()
    {
        $data = Yii::$app->navhelper->dropdown('Countries', 'Code', 'Name');
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $data;
    }

    public function actionPostalcodes()
    {
        $data = Yii::$app->navhelper->dropdown('PostalCodes', 'Code', 'City', [], ['Code', 'Country_Region_Code', 'County']);
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
