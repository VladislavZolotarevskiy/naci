<?php
/* @var $this yii\web\View */
/* @var $incident frontend\incidents\IncidentSteps */

if ($incident->ref_company_id === 1) {
    switch ($ref_type_steps_id) {
        case 1:
            $this->title = 'Открытие инцидента на ВОЛС ООО "Единство" № '.$incident->inc_number;
        break;
        case 2:
            $this->title = 'Дополнение по инциденту на ВОЛС ООО "Единство" № '.$incident->inc_number;
        break;
        case 3:
            $this->title = 'Закрытие инцидента на ВОЛС ООО "Единство" № '.$incident->inc_number;
        break;
    }
}
elseif ($incident->ref_company_id === 2) {
    if ($incident->type === 1) {
        switch ($ref_type_steps_id) {
        case 1:
            $this->title = 'Открытие ИТ инцидента № '.$incident->inc_number;
        break;
        case 2:
            $this->title = 'Дополнение по ИТ инциденту № '.$incident->inc_number;
        break;
        case 3:
            $this->title = 'Закрытие ИТ инцидента № '.$incident->inc_number;
        break;
        }
    }
    elseif ($incident->type ===2) {
        switch ($ref_type_steps_id) {
        case 1:
            $this->title = 'Открытие кризисного ИТ инцидента № '.$incident->inc_number;
        break;
        case 2:
            $this->title = 'Дополнение по кризисному ИТ инциденту № '.$incident->inc_number;
        break;
        case 3:
            $this->title = 'Закрытие кризисного ИТ инцидента № '.$incident->inc_number;
        break;
        }
    }    
}
?>
<div class="incident-steps-create">
    
    <?= $this->render('_createform', [
        'model' => $model,
        'importance' => $importance,
        'ref_type_steps_id' => $ref_type_steps_id,
        'incident_id' => $incident_id,
        'old_step' => $old_step
    ]) ?>

</div>
