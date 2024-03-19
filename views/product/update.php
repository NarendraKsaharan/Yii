<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Product $model */

$this->title = 'Create Product';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="product-form">
        <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data'],
        ]); ?>
        <div class="row mt-3">
            <div class="col-md-6">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            
            <div class="col-md-6">
                <?= $form->field($model, 'status')->dropDownList([
                    ' ' => 'Select Status',
                    '1' => 'Enable',
                    '2' => 'Disable', 
                ]) ?>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <?= $form->field($model, 'price')->textInput() ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'qty')->textInput() ?>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <?= $form->field($model, 'url_key')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
            </div>
            <div class="col-md-6">
            <?= $form->field($model, 'category_id')->listBox(
                \yii\helpers\ArrayHelper::map($category, 'id', 'name'),
                ['multiple' => true, 'name' => 'Product[category_id][]']
            ) ?>
            </div>
        </div>
        
        <div class="row mt-3">
            <div class="col-md-6">
                <?= $form->field($model, 'image')->fileInput() ?>
            </div>
            
            <div class="col-md-6">
            </div>
        </div>
        <div class="row mt-3">
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
