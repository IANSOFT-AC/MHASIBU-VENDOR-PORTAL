<?php 

namespace app\models;

use Yii;
use yii\base\Model;

class VendorCard extends Model
{
    public $No;
    public $Name;
    public $Balance_LCY;
    public $Balance_Due_LCY;
    public $Generated_Vendor_No;
    public $Status;
    public $Address;
    public $Address_2;
    public $Post_Code;
    public $City;
    public $Country_Region_Code;
    public $Phone_No;
    public $E_Mail;
    public $Fax_No;
    public $Home_Page;
    public $Supplier_Type;
    public $Application_Date;
    public $AGPO_Certificate;
    public $Trade_Licennse_No;
    public $Certificate_of_Incorporation;
    public $Registration_No;
    public $Registration_Date;
    public $Tax_Compliance_Certificate_No;
    public $Tax_Compliance_Expiry_Date;
    public $VAT_Certificate_No;
    public $PIN_No;
    public $No_of_Businesses_at_one_time;
    public $Registration_Status;
    public $Payment_Terms_Code;
    public $Payment_Method_Code;
    public $PortalId;
    public $HasAcceptedTermsAndConditions;
    public $Key;

    public $isNewRecord;

    
    public function rules()
    {
        return [
            [['Name', 'Phone_No', 'HasAcceptedTermsAndConditions'], 'required'],           
            ['HasAcceptedTermsAndConditions', 'compare', 'compareValue' => 1, 'message' => 'You should accept term Our Terms and Condiitions'],
            ['Home_Page', 'url'],
            ['E_Mail', 'email'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
                  'HasAcceptedTermsAndConditions'=>'Do you Accept Our Terms and Conditions'
        ];
    }

    public function hasProfile()
    {
        $model = new VendorCard();
        $service = Yii::$app->params['ServiceName']['VendorCard'];
        $model = Yii::$app->navhelper->findOne($service,'','No', Yii::$app->user->identity->vendorNo);
        if(is_object($model))
        {
            return true;
        }

        return false;
    }


}
?>