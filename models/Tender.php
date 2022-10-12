<?php

namespace app\models;
use Yii;
use yii\base\Model;




class Tender extends Model{
    public $Key;
    public $No;
    public $Status;
    public $Title;
    public $Requisiton_No;
    public $Current_Budget;
    public $Supplier_Category;
    public $Tender_Opening_Date;
    public $Tender_Duration;
    public $Tender_Closing_Date;
    public $Extension_Period;
    public $Extended_Closing_Date;
    public $Global_Dimension_1_Code;
    public $Requires_Inspection;
    public $Tender_Security_Amount;
    public $Tender_Max_Score;
    public $Technical_Pass_Mark;
    public $Technical_Score;
    public $Financial_Score;
    public $Technical_Total_Scores;
    public $Technical_Evaluation_Period;
    public $Financial_Evaluation_Period;
    public $Procurement_Plan;
    public $Tender_Type;
    public $Vendor_No;
    public $Minimum_No_of_Suppliers;
    public $Date_of_Financial_Evaluation;
    public $Date_of_Technical_Evaluation;
    public $Date_of_Mandatory_Evaluation;
    public $Date_Advertisement;
    public $Date_Awarded;



    public function rules()
    {
        return [
           
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Global_Dimension_1_Code' => 'Department ',
        ];
    }

}

?>

