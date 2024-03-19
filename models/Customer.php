<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property int $id
 * @property int $user_id
 * @property string $address
 * @property string $city
 * @property string $country
 * @property int $pincode
 * @property string $about
 * @property string $company
 * @property string $job_title
 * @property string $phone
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'address', 'city', 'country', 'pincode', 'about', 'company', 'job_title', 'phone'], 'required'],
            [['user_id', 'pincode'], 'integer'],
            [['address', 'about'], 'string'],
            [['user_id'], 'safe'],
            [['city', 'country', 'company', 'job_title', 'phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'address' => 'Address',
            'city' => 'City',
            'country' => 'Country',
            'pincode' => 'Pincode',
            'about' => 'About',
            'company' => 'Company',
            'job_title' => 'Job Title',
            'phone' => 'Phone',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
