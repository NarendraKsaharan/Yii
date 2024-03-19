<?php

use app\models\Employee;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\EmployeeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Employees';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Employee', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'email:email',
            // 'phone',
            [
                'attribute' => 'gender',
                'value'     => function ($data) {
                    if ($data->gender == 1) {
                        return 'Male';
                    } elseif ($data->gender == 2) {
                        return 'Female';
                    } else {
                        return 'Others';
                    }
                }
            ],
            //'status',
            //'h_date',
            'dob',
            //'address:ntext',
            //'country',
            //'state',
            //'city',
            //'pincode',
            //'salary',
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
            //'image',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Employee $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
