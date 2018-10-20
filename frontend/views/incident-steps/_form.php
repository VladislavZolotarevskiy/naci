<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\RefImportance;
use frontend\assets\CustomAsset;
use frontend\models\IncidentSteps;

/* @var $this yii\web\View */
/* @var $model frontend\models\IncidentSteps */
/* @var $form yii\widgets\ActiveForm */
CustomAsset::register($this);
$allo = IncidentSteps::find()
        ->select('id, service_stop_marker, clock')
        ->where(['incident_id' => 12])
        ->orderBy('clock ASC')
        ->all();
?>
<?php
$stoppage = null;
foreach($allo as $item) {
    if($item->service_stop_marker == 1) {
        $stoppage_start = strtotime($item->clock);
    }
    else {
        
    }
}
?>
<pre>
    <?= $item->clock ?>
</pre>

<div class="incident-steps-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'clock')->widget(kartik\datetime\DateTimePicker::classname(), [
        'language' => 'ru',
        'removeButton' => false,
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd hh:ii:ss']
        ]);?>

    <?= $form->field($importance, 'ref_importance_id')->dropDownList(RefImportance::importanceList()) ?>

    <?= $form->field($model, 'res_person')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'super_person')->textInput(['readonly' => 'readonly']) ?>

    <?= $form->field($model, 'no_send')->checkbox() ?>
    
    <?= $form->field($model, 'service_stop_marker')->checkbox() ?>

    <?= $form->field($model, 'message')->textarea(['maxlength' => true]) ?>

    <div class="form-group">

    <?= Html::a('Назад', ['incident/view', 'id' => $model->incident_id], ['class' => 'btn btn-danger']) ?>

    <?= Html::submitButton('Далее', ['class' => 'btn btn-primary']) ?>

    </div>

    <?php ActiveForm::end(); ?>
   
</div>
