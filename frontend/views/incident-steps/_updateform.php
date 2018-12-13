<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\IncidentSteps */
/* @var $form yii\widgets\ActiveForm */
//$current_datetime = date('Y-m-d h:i:s');
?>
<div class="incident-steps-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ref_type_steps_id')->hiddenInput(['value' => $ref_type_steps_id])->label(false) ?>

    <?= $form->field($model, 'clock')->widget(kartik\datetime\DateTimePicker::classname(), [
        'name' => 'datetime_10',
        'language' => 'ru',
        'removeButton' => false,
        'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd hh:ii:ss',
        ]
    ]);?>
    
    
    <?= $form->field($model, 'incident_id')->hiddenInput()->label(false) ?>
    
    <?= $form->field($model, 'res_person')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'super_person')->textInput(['readonly' => 'readonly']) ?>
    
    <?= $form->field($model, 'message')->textarea(['maxlength' => true]) ?>
    
    
    <div class="form-group">
    
    <?= Html::a('Назад', ['/incident/view', 'id' => $model->incident_id], ['class' => 'btn btn-danger']) ?>
    
    <?= Html::submitButton('Далее', ['class' => 'btn btn-primary']) ?>
    
    </div>

    <?php ActiveForm::end(); ?>

</div>
