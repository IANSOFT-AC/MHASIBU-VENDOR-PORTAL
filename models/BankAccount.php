<?php

namespace app\models;
use Yii;
use yii\base\Model;
use borales\extensions\phoneInput\PhoneInputValidator;



class BankAccount extends Model{
    public $Key;
    public $Supplier_No;
    public $Code;
    public $Name;
    public $Address;
    public $City;
    public $Post_Code;
    public $Contact;
    public $Bank_Branch_No;
    public $Bank_Account_No;
    public $E_Mail;
    public $SWIFT_Code;



    public function rules()
    {
        return [
            [['Bank_Account_No', 'City', 'Partner_Occupation' ,'Name','SWIFT_Code'], 'required'],
            ['Email', 'email'],
           

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Code' => 'Bank Code (Update Appropriately.)',
            'Name' => 'Account Name'
        ];
    }

}

?>

