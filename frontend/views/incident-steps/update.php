<?php
/* @var $this yii\web\View */
/* @var $model frontend\models\IncidentSteps */


if ($model->ref_type_steps_id == 1){
    $this->title = 'Открытие инцидента № '.$inc_number;
}
elseif ($model->ref_type_steps_id == 2){
    $this->title = 'Дополнение по инциденту № '.$inc_number;
}
elseif ($model->ref_type_steps_id == 3){
    $this->title = 'Закрытие инцидента № '.$inc_number;
}
?>
<div class="incident-steps-create">
  
    <?= $this->render('_updateform', [
        'model' => $model,
        'importance' => $importance,
        'ref_type_steps_id' => $model->ref_type_steps_id,
        'incident_id' => $incident_id,
    ]) ?>

</div>
