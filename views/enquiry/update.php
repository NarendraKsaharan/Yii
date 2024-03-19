<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;

$this->title = 'Enquiry';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="enquiry-form">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success">
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>

    <?php $form = ActiveForm::begin([
          'id' => 'enquiry-form',
          'enableAjaxValidation' => true,
          'validationUrl' => ['enquiry/create'], 
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<?php

$this->registerJs(new JsExpression('
    $("#enquiry-form").on("beforeSubmit", function(e) {
        e.preventDefault();
        var form = $(this);
        $.ajax({
            url: form.attr(""),
            type: "post",
            data: form.serialize(),
            success: function(response) {
                if (response.success) {
                    // Handle success
                    alert(response.message);
                } else {
                    // Handle errors
                    console.log(response.errors);
                }
            },
        });
    }).on("submit", function(e) {
        e.preventDefault();
    });
'));

?>
