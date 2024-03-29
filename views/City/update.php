<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\City $model */

$this->title = 'Update City: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cities', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="city-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'country_id')->dropDownList([
    '' => 'Select Country' ] + \yii\helpers\ArrayHelper::map($country, 'id', 'name')    
    ) ?>

    <?= $form->field($model, 'state_id')->dropDownList([
        '' => 'Select State' ] + \yii\helpers\ArrayHelper::map($state, 'id', 'name')
        ) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>


    <div class="form-group mt-2">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script  rel="javascript" type="text/javascript">
    
    $(document).ready(function() {
        
        $('#city-country_id').change(function(){
            
        var countryId = $('#city-country_id').val();

            $.ajax({ 
                url     : '<?= Yii::$app->request->baseUrl. '/index.php?r=city/get-state' ?>',
                type    : 'POST', 
                data    : { country_id: countryId },
                success : function(data) { 
                   var data = JSON.parse(data) 
                   var html="<option value=>Select State</option>";
                        $.each(data,function(r,state){
                            html+="<option value="+state.state_id+">"+state.state_name+"</option>";
                        });
                        $("#city-state_id").html(html);

                    },
                error   : function (data) {
                        alert(data);
                        console.log(data);
                    },
            });
        });
    });
</script>
