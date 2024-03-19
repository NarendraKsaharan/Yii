<?php

namespace app\models;


use Yii;
use yii\db\ActiveRecord;

class Enquiry extends ActiveRecord
{

    public static function tableName()
    {
        return 'enquiry';
    }

    public function rules()
    {
        return [
            [['name', 'email', 'phone', 'message'], 'required'],
            [['name', 'email', 'phone'], 'string'],
            [['name'], 'safe'],
            [['email'], 'email'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name'    => 'Name',
            'email'   => 'Email',
            'phone'   => 'Phone',
            'message' => 'Message'
        ];
    }
}



?>