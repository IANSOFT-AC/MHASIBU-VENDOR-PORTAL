<?php

namespace app\models;

use Yii;
use yii\base\Model;




class Attachment extends Model
{
    public $Key;
    public $Supplier_No;
    public $Name;
    public $File_path;

    public $attachment;
    public $type;




    public function rules()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [];
    }
}
