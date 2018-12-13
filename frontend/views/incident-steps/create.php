<?php
/* @var $this yii\web\View */
/* @var $model frontend\models\IncidentSteps */


if ($ref_type_steps_id == 1){
    $this->title = 'Открытие инцидента № '.$inc_number;
}
elseif ($ref_type_steps_id == 2){
    $this->title = 'Дополнение по инциденту № '.$inc_number;
}
elseif ($ref_type_steps_id == 3){
    $this->title = 'Закрытие инцидента № '.$inc_number;
}
?>
<div class="incident-steps-create">
    
    <?= $this->render('_form', [
        'model' => $model,
        'importance' => $importance,
        'ref_type_steps_id' => $ref_type_steps_id,
        'incident_id' => $incident_id,
        'old_step' => $old_step
    ]) ?>

</div>
