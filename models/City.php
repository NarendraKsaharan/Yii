<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property int $id
 * @property int|null $country_id
 * @property int|null $state_id
 * @property string $name
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country_id', 'state_id', 'status'], 'integer'],
            [['name', 'status'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country_id' => 'Country ID',
            'state_id' => 'State ID',
            'name' => 'Name',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
}
