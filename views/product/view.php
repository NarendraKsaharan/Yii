<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Product $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute' => 'status',
                'value'     => function ($data) {
                    return ($data->status == 1) ? 'Enable' : 'Disable';
                }
            ],
            'qty',
            'price',
            'description:ntext',
            'url_key:url',
            'meta_title',
            [
                'attribute' => 'Categories',
                'value' => function ($model) {
                    $categories = $model->categories;
                    $categoryNames = [];
                    foreach ($categories as $category) {
                        $categoryNames[] = $category->name;
                    }
                    return implode(', ', $categoryNames);
                },
            ],
            [
                'attribute' => 'Image',
                'format' => 'raw', // Use raw format to render HTML
                'value' => function ($model) {
                    return Html::img('/images/' . $model->image, ['alt' => 'Product Image']);
                },
            ],
            
        ],
    ]) ?>
    <?= Html::a('Product Detail', ['detail', 'id' => $model->id], ['class' => 'btn btn-info']) ?>


</div>
