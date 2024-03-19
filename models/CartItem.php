<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class CartItem extends ActiveRecord
{
    public static function tableName()
    {
        return 'cart_item'; // Replace 'cart_item' with your actual table name if different
    }

    public function rules()
    {
        return [
            [['cart_id', 'product_id', 'qty'], 'required'],
            [['cart_id', 'product_id'], 'integer'],
            [['qty'], 'integer', 'min' => 1],
            // Add more validation rules as needed
        ];
    }

    // Define relations with other models, e.g., Product
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }
}
