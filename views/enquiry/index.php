<?php

use app\models\Enquiry;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\web\JsExpression;

/** @var yii\web\View $this */
/** @var app\models\CountrySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Enquiries';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .enquiry-popup {
        top: 10%;
        left: 10%;
        /* transform: translate(-50%, -50%); */
        width: 60%; 
        max-width: 800px; 
    }

    .enquiry-popup-body {
        max-height: 60vh; 
        overflow-y: auto;
        /* padding: 20px;  */
    }

    .modal-backdrop.show {
        backdrop-filter: blur(5px); 
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .enquiry-header {
        background-color: #007BFF; 
        color: #fff; 
        border: none; 
    }

    .enquiry-title {
        font-size: 20px; 
    }
</style>
<div class="enquiry-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?= Html::button('Create Enquiry', ['class' => 'btn btn-primary', 'id' => 'create-enquiry-button']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'email',
            'phone',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Enquiry $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id], ['class' => 'update-enquiry-button']);
                 }
            ],
        ],
    ]); ?>


</div>

<div class="modal fade" id="create-enquiry-modal" tabindex="-1" role="dialog" aria-labelledby="create-enquiry-modal-label">
    <div class="modal-dialog enquiry-popup" role="document">
        <div class="modal-content">
            <div class="modal-header enquiry-header">
                <h4 class="modal-title enquiry-title" id="create-enquiry-modal-label">Create Enquiry</h4>
            </div>
            <div class="modal-body enquiry-popup-body" id="create-enquiry-modal-content">
             
            </div>
        </div>
    </div>
</div>
<?php
$this->registerJs(new JsExpression('
    $(document).on("click", "#create-enquiry-button", function() {
        // Load the create form via AJAX
        $.get("' . Url::to(['enquiry/create']) . '", function(data) {
            $("#create-enquiry-modal-content").html(data);
            $("#create-enquiry-modal").modal("show");
        });
    });
'));
?>
<?php
$this->registerJs(new JsExpression('
    $(document).on("click", ".update-enquiry-button", function() {
        // Load the create form via AJAX
        $.get("' . Url::to(['enquiry/update']) . '", function(data) {
            $("#create-enquiry-modal-content").html(data);
            $("#create-enquiry-modal").modal("show");
        });
    });
'));
?>


