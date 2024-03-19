<?php

namespace app\models;

use yii\db\ActiveRecord;

class ProductCategory extends ActiveRecord
{
    public static function tableName()
    {
        return 'product_category'; // Table name for the junction table
    }

    public function rules()
    {
        return [
            [['product_id', 'category_id'], 'required'],
            [['product_id', 'category_id'], 'integer'],
        ];
    }

    // Define the relation to the Product model
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    // Define the relation to the Category model
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}





?>