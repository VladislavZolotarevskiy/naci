<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\RefImportance;
use frontend\assets\CustomAsset;

/* @var $this yii\web\View */
/* @var $model frontend\models\IncidentSteps */
/* @var $form yii\widgets\ActiveForm */
CustomAsset::register($this);
//if ($ref_type_steps_id == 3){
  //$starting_time_inc = $model->needlessTime($incident_id, 1)['clock'];
  //$data1 = new DateTime($model->clock);
  //$data2 = new DateTime($starting_time_inc);
  //$interval = $data1->diff($data2);
  //$datetime_hour = ($interval->format('%D')*24)+$interval->format('%H');
  //$datetime_min = $interval->format('%i');
//  if (($datetime_hour < 10)&&($datetime_min < 10)) {
//      $duration_result = '0'.$datetime_hour.':0'.$datetime_min;
//  }
//  elseif ($datetime_min < 10) {
//      $duration_result = $datetime_hour.':0'.$datetime_min;
//  }
//  elseif ($datetime_hour < 10) {
//      $duration_result = '0'.$datetime_hour.':'.$datetime_min;
//  }
//  else {
//      $duration_result = $datetime_hour.':'.$datetime_min;
//  }
//  $model->message = $this->title.'. Завершение: '.$model->clock.
//  '. Продолжительность: '.$duration_result.'.';
//}
//elseif ($ref_type_steps_id == 1){
//  $model->message = $this->title.'. Начало: '.$model->clock.'. ';
//}
//else {
//    $model->message = $this->title.'. Начало: '.$model->needlessTime(
//      $model->incident_id, 1)['clock'].'. ';
//}
?>
<div class="incident-steps-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'clock')->widget(kartik\datetime\DateTimePicker::classname(), [
        'language' => 'ru',
        'removeButton' => false,
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd hh:ii:ss',
        ]]);?>

    <?= $form->field($importance, 'ref_importance_id')->dropDownList(RefImportance::importanceList()) ?>

    <?= $form->field($model, 'res_person')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'super_person')->textInput(['readonly' => 'readonly']) ?>

    <?= $form->field($model, 'no_send')->checkbox() ?>

    <?= $form->field($model, 'message')->textarea(['maxlength' => true]) ?>

    <div class="form-group">

    <?= Html::a('Назад', ['incident/view', 'id' => $model->incident_id], ['class' => 'btn btn-danger']) ?>

    <?= Html::submitButton('Далее', ['class' => 'btn btn-primary']) ?>

    </div>

    <?php ActiveForm::end(); ?>
   
</div>
