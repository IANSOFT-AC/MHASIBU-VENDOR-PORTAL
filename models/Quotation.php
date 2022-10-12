<?php

namespace app\models;
use Yii;
use yii\base\Model;




class Quotation extends Model{
    public $Key;
    public $No;
    public $Status;
    public $Title;
    public $Requisiton_No;
    public $Current_Budget;
    public $Supplier_Category;
    public $Global_Dimension_1_Code;
    public $Quotation_Start_Date;
    public $Quotation_Period;
    public $Quotation_End_Date;
    public $Procurement_Plan;
    public $Requires_Inspection;



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

