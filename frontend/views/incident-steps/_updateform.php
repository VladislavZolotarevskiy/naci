<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\RefImportance;
use frontend\assets\CustomAsset;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model frontend\models\IncidentSteps */
/* @var $form yii\widgets\ActiveForm */
CustomAsset::register($this);
?>
<div class="incident-steps-form">
    <?php $form = ActiveForm::begin([
        'id' => 'incident-steps-create-form'
    ]); ?>

    <?= $form->field($model, 'clock')->widget(kartik\datetime\DateTimePicker::classname(), [
        'language' => 'ru',
        'removeButton' => false,
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd hh:ii:ss']
        ]);?>
    
    <?php if ($ref_type_steps_id == 3):?>
    <?= $form->field($importance, 'ref_importance_id')->dropDownList(RefImportance::importanceList(), ['disabled' => 'disabled'])?>
        
    <?php else :?>
    <?= $form->field($importance, 'ref_importance_id')->widget(Select2::classname(),[
        'data' => RefImportance::importanceList(),
        'options' => ['placeholder' => 'Выберите приоритет'],
        'language' => 'ru',
        'pluginEvents' => [
            "select2:select" => "function() { var alerts; alerts = $('#incident-steps-create-form').serialize();$.get('update',alerts+'&ref_type_steps_id=$ref_type_steps_id&incident_id=$incident_id',function(data){ $('#incident-steps-create-form').replaceWith(data);});} "],
    ])?> <?php endif ?>
    
    <?= $form->field($model, 'res_person')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'super_person')->textInput(['readonly' => 'readonly']) ?>
    
    <?php if ($importance->ref_importance_id != 4):?>
    <?= $form->field($model, 'no_send')->checkbox() ?>
    <?php endif ?>
    <?= $form->field($model, 'service_stop_marker')->checkbox() ?>

    <?= $form->field($model, 'message')->textarea(['maxlength' => true]) ?>

    <div class="form-group">

    <?= Html::a('Назад', ['incident/view', 'id' => $model->incident_id], ['class' => 'btn btn-danger']) ?>

    <?= Html::submitButton('Далее', ['class' => 'btn btn-primary']) ?>

    </div>

    <?php ActiveForm::end(); ?>
   
</div>