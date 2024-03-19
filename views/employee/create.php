<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Employee $model */

$this->title = 'Create Employee';
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="employee-form">

        <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data'],
        ]); ?>

        <div class="row mt-3">
            <div class="col-md-6">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'gender')->radioList([
                    '1' => 'Male',
                    '2' => 'Female',
                    '0' => 'Other'
                ]) ?>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <?= $form->field($model, 'status')->dropDownList([
                    ''  => 'Select Status',
                    '1' => 'Active',
                    '2' => 'InActive',
                ]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'h_date')->textInput() ?>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <?= $form->field($model, 'dob')->textInput() ?>
            </div>
            <div class="col-md-6">        
                <?= $form->field($model, 'salary')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
            <?php $cnt = ArrayHelper::map($country, 'id', 'name'); ?>
                <?= $form->field($model,'country_id')->dropDownList($cnt,['prompt'=>'Select Country'])->label('Country');
            ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model,'state_id')
                    ->dropDownList(array(), array(
                        'prompt'=>'Select State'
                    ))->label('State');
                ?>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <?= $form->field($model,'city_id')
                    ->dropDownList(array(), array(
                        'prompt'=>'Select City'
                    ))->label('City');
                ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'pincode')->textInput() ?>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'hobbies')->checkboxList([
                    'A' => 'Reading',
                    'B' => 'Singing',
                    'C' => 'Travel',
                    'D' => 'Gaming',
                    'E' => 'Cooking', 
                ],
                [   'itemOptions' => ['labelOptions' => ['class' => 'checkbox-inline']],
                    'separator' => '<br>', 'tag' => 'div', 'class' => 'checkbox']
                ) ?>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <?= $form->field($model, 'image')->fileInput() ?>
            </div>
        </div>
        <div class="form-group mt-3">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script  rel="javascript" type="text/javascript">
    
    $(document).ready(function() {
        
        $('#employee-country_id').change(function(){
            
        var countryId = $('#employee-country_id').val();

            $.ajax({ 
                type    : 'POST', 
                url     : '<?php echo Yii::$app->request->baseUrl. '/index.php?r=employee/state' ?>',
                data    : { country_id: countryId },
                success : function(data) { 
                   var data = JSON.parse(data) 
                    var html="<option value=>Select state</option>";
                        $.each(data,function(key,state){
                            html+="<option value="+state.state_id+">"+state.state_name+"</option>";
                        });
                        $("#employee-state_id").html(html);

                    },
                error   : function (data) {
                        alert('error');
                        console.log(data);
                    },
            });
        });
    });
</script>

<script  rel="javascript" type="text/javascript">
    
    $(document).ready(function() {
        
        $('#employee-state_id').change(function(){
            
        var stateId = $('#employee-state_id').val();

            $.ajax({ 
                type    : 'POST', 
                url     : '<?php echo Yii::$app->request->baseUrl. '/index.php?r=employee/city' ?>',
                data    : { state_id: stateId },
                success : function(data) { 
                   var data = JSON.parse(data) 
                    var html="<option value=>Select City</option>";
                        $.each(data,function(key,city){
                            html+="<option value="+city.city_id+">"+city.city_name+"</option>";
                        });
                        $("#employee-city_id").html(html);

                    },
                error   : function (data) {
                        alert('error');
                        console.log(data);
                    },
            });
        });
    });
</script>

