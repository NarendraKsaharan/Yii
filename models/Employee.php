<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property int $gender
 * @property int $status
 * @property string $h_date
 * @property string $dob
 * @property string $address
 * @property int $country_id
 * @property int $state_id
 * @property int $city_id
 * @property int $pincode
 * @property float $salary
 * @property string $hobbies
 * @property string $image
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee';
    }



    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'phone', 'gender', 'status', 'h_date', 'dob', 'address', 'country_id', 'state_id', 'city_id', 'pincode', 'salary'], 'required'],
            [['gender', 'status', 'pincode', 'country_id', 'state_id', 'city_id'], 'integer'],
            // [['h_date', 'dob'], 'safe'],
            [['address'], 'string'],
            [['salary'], 'number'],
            [['hobbies'], 'safe'],
            [['name', 'email', 'phone', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'      => 'ID',
            'name'    => 'Name',
            'email'   => 'Email',
            'phone'   => 'Phone',
            'gender'  => 'Gender',
            'status'  => 'Status',
            'h_date'  => 'Hire Date',
            'dob'     => 'Date Of Birth',
            'address' => 'Address',
            'country' => 'Country',
            'state'   => 'State',
            'city'    => 'City',
            'pincode' => 'Pincode',
            'salary'  => 'Salary',
            'hobbies' => 'Hobbies',
            'image'   => 'Image',
        ];
    }

    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }

    public function getState()
    {
        return $this->hasOne(State::className(), ['id' => 'state_id']);
    }

    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }
}
