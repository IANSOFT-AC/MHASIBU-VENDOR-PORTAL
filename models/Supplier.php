<?php

namespace app\models;

use Yii;
use yii\base\Model;
use borales\extensions\phoneInput\PhoneInputValidator;
use yii\db\ActiveRecord;

class Supplier extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%user}}';
    }

    // Get Generated Vendor No

    public function getVendorNo()
    {
        $SupplierNo =  Yii::$app->user->identity->VendorId;
        $vendor = Yii::$app->navhelper->findOne('VendorCard',[],['No' =>  $SupplierNo]);
        return $vendor->Generated_Vendor_No ?? null;
    }
}
