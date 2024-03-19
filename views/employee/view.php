<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Employee $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="employee-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
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
            'email:email',
            'phone',
            [
                'attribute' => 'gender',
                'value'     => function ($data) {
                    return ($data->gender == 1) ? 'Male' : 'Female';
                }
            ],
            [
                'attribute' => 'status',
                'value'     => function ($data) {
                    return ($data->status == 1) ? 'Active' : 'InActive';
                }
            ],
            'h_date',
            'dob',
            'address:ntext',
           [
                'attribute' => 'country_id',
                'value'     => $model->country->name,
           ],
           [
                'attribute' => 'state_id',
                'value'     => $model->state->name,
           ],
           [
                'attribute' => 'city_id',
                'value'     => $model->city->name,
           ],
            'pincode',
            'salary',
            [
                'attribute' => 'hobbies',
                'value'     => function ($model) {
                    $hobbyMapping = [
                        'A' => 'Reading',
                        'B' => 'Singing',
                        'C' => 'Travel',
                        'D' => 'Gaming',
                        'E' => 'Cooking', 
                    ];
                    $hobbies = [];
                    $model->hobbies = explode(', ', $model->hobbies);
                    foreach ($model->hobbies as $value ) {
                        if (isset($hobbyMapping[$value])) {
                            $hobbies[] = $hobbyMapping[$value];
                        }
                    }
                    return implode(', ', $hobbies);
                },
            ],
            'image',
        ],
    ]) ?>

</div>
