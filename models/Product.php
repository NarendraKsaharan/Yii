<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property int $status
 * @property int $qty
 * @property float $price
 * @property string $description
 * @property string $url_key
 * @property string $meta_title
 * @property string $image
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    public $category_id;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'status', 'qty', 'price', 'description', 'url_key', 'meta_title','category_id'], 'required'],
            [['status', 'qty'], 'integer'],
            [['price'], 'number'],
            [['description'], 'string'],
            [['name', 'url_key', 'meta_title', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'category_id' => 'Category ID',
            'status' => 'Status',
            'qty' => 'Qty',
            'price' => 'Price',
            'description' => 'Description',
            'url_key' => 'Url Key',
            'meta_title' => 'Meta Title',
            'image' => 'Image',
        ];
    }

    // public function getCategory()
    // {
    //     return $this->hasOne(Category::className(), ['id' => 'category_id']);
    // }

    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])
            ->viaTable('product_category', ['product_id' => 'id']);
    }

}
