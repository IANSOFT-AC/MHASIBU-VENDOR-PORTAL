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

    public static function VendorNo()
    {
        $SupplierNo =  Yii::$app->user->identity->VendorId;
        $vendor = Yii::$app->navhelper->findOne('VendorCard',[],['No' =>  $SupplierNo]);
        return $vendor->Generated_Vendor_No ?? null;
    }

    public static function Vendor()
    {
        $SupplierNo =  Yii::$app->user->identity->VendorId;
        $vendor = Yii::$app->navhelper->findOne('VendorCard',[],['No' =>  $SupplierNo]);
        return (is_object($vendor) && !empty($vendor->Key))? $vendor : null;
    }

    public static function IsBidder($QuoteID) 
    {
        $service = Yii::$app->params['ServiceName']['quotationBidders'];
        $filter = [
            'Reference_No' =>  $QuoteID,
            'Vendor_No' => self::VendorNo()
        ];
        //Yii::$app->recruitment->printrr($filter);
        $result = Yii::$app->navhelper->getData($service, $filter);

        return is_array($result)? true : false;
    }
}
