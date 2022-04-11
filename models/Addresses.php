<?php

namespace app\models;
use Yii;
use yii\base\Model;




class Addresses extends Model{
    public $Key;
    public $Supplier_No;
    public $Address;
    public $Post_Code;
    public $City;
    public $Country_Code;
    public $Physical_Location;
    public $Telephone_No;
    public $E_mail;



    public function rules()
    {
        return [
            [['Address','Post_Code'], 'required'],
            ['E_mail', 'email'],
            ['Telephone_No','string', 'length' => [10, 14]]
           

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

