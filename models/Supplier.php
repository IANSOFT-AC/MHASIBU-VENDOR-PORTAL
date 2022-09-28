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
}
