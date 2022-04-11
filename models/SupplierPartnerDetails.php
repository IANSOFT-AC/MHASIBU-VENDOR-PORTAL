<?php

namespace app\models;
use Yii;
use yii\base\Model;
use borales\extensions\phoneInput\PhoneInputValidator;



class SupplierPartnerDetails extends Model{
    public $Key;
    public $Vendor_No;
    public $Partner_ID_No;
    public $Partner_Name;
    public $Patrner_Address;
    public $City;
    public $Partner_Occupation;
    public $PIN;
    public $Mobile_No__x002B_254;
    public $Gender;
    public $Shares;
    public $Nationality;
    public $Passport_No;
    public $Supplier_No;


    public function rules()
    {
        return [
            [['Partner_ID_No', 'Partner_Name', 'Partner_Occupation' ,'PIN', 'Mobile_No__x002B_254', 'Gender', 'Shares', 'Nationality' ], 'required'],
            ['Shares', 'number',  'min' => 1],
            ['Email', 'email'],
            ['Partner_ID_No', 'string','min' => 8],
            [['Mobile_No__x002B_254'], PhoneInputValidator::className()],
            ['Partner_ID_No', 'string','max' => 10]

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Mobile_No__x002B_254'=>'Phone No',
            'Partner_ID_No' => 'Partner ID No (Update Appropriately.)',
            'PIN' => 'KRA PIN'
        ];
    }

}

?>

