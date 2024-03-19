<?php
/** @var yii\web\View $this */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'User Create';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-create">
    <h1><?= Html::encode($this->title) ?></h1>
</div>

<div class="card">
    <div class="card-body">
          <h5 class="card-title">Create Here!</h5>
<div class="row g-3">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

        <div class="col-12 mt-2">
            <?= $form->field($user, 'name')->textInput() ?>
        </div>
        <div class="col-12 mt-2">
            <?= $form->field($user, 'username')->textInput() ?>
        </div>
        <div class="col-12 mt-2">
            <?= $form->field($user, 'email')->textInput() ?>
        </div>
        <div class="col-12 mt-2">
            <?= $form->field($user, 'password')->textInput() ?>
        </div>
        <div class="col-12 mt-2">
            <?= $form->field($user, 'confirm_password')->textInput() ?>
        </div>
        <div class="col-12 mt-2">
            <?= $form->field($user, 'authKey')->textInput() ?>
        </div>
        <div class="col-12 mt-2">
            <?= $form->field($user, 'role')->dropDownList([
                ' ' => 'Select Role' ] + \yii\helpers\ArrayHelper::map($role, 'id', 'name')
            ) ?>
        </div>
        <div class="col-12 mt-2">
            <?= $form->field($user, 'image')->fileInput() ?>
        </div>
        <div class="text-center mt-3">
            <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
        </div>

    </div>
</div>
    <?php ActiveForm::end() ?>
</div>
