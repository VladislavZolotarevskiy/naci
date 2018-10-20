<?php


use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\datetime\DateTimePicker;
use frontend\models\RefImportance;
use frontend\models\Incident;
/* @var $this yii\web\View */
/* @var $model frontend\models\IncidentSteps */
$inc_num = Incident::findOne($model->incident_id)->inc_number;

if ($model->ref_type_steps_id == 1){
    $this->title = 'Открытие инцидента № '.$inc_num ;
}
elseif ($model->ref_type_steps_id == 2){
    $this->title = 'Дополнение по инциденту № '.$inc_num;
}
elseif ($model->ref_type_steps_id == 3){
    $this->title = 'Закрытие инцидента № '.$inc_num;
}
else {
    $this->title = 'unbelievable';
}
?>
<?php $form = ActiveForm::begin(); ?>
<div class="incident-steps-view">
    <?= $form->field($model, 'clock')->widget(DateTimePicker::classname(), [
        'name' => 'datetime_10',
        'type' => DateTimePicker::TYPE_INPUT, 
        'language' => 'ru',
        'removeButton' => false,
        'disabled' => true,
        'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd hh:ii:ss'
        ]
    ]);?>
    
    <?= $form->field($importance, 'ref_importance_id')->dropDownList(RefImportance::importanceList(), ['disabled' => 'disabled']) ?>

    <?= $form->field($model, 'res_person')->textInput(['disabled' => 'disabled']) ?>

    <?= $form->field($model, 'super_person')->textInput(['disabled' => 'disabled']) ?>

    <?= $form->field($model, 'no_send')->checkbox(['disabled' => 'disabled']) ?>

    <?= $form->field($model, 'message')->textarea(['disabled' => 'disabled']) ?>

    <?= Html::a('Назад', ['/incident/view', 'id' => $model->incident_id], ['class' => 'btn btn-danger']) ?>
</div>

    <?php ActiveForm::end(); ?>


