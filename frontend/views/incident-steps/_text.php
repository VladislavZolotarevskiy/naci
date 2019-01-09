<?php
use frontend\models\Incident;
use frontend\models\IncidentSteps;
$starting_time_inc = IncidentSteps::needlessTime($model->incident_id, 1)['clock'];
$incident = Incident::findOne($model->incident_id);
$snapshot = json_decode($model->snapshot, true);
//Инцидент на инфраструктуре
if ($incident->ref_company_id === 2) {
    //Открытие
    if ($ref_type_steps_id === 1) {
        $this->title = 'Открытие инцидента № '.$incident->inc_number;
        $text = $this->title . '. Начало: '.$model->clock
            .'. Приоритет: '.$model->refImportance->name. '. '.$model->message
            .'. Ответственный: '.$model->res_person.'. Контроль:'
            .$model->super_person.' +79873242404, +74957877667 доб. 7377.';
    }
    //Дополнение
    elseif ($ref_type_steps_id === 2) {
        $this->title = 'Дополнение по инциденту № '.$incident->inc_number;
        $text = $this->title. '. Начало: '.$starting_time_inc
            .'. Приоритет: ' .$model->refImportance->name.'. '.$model->message
            .'. Ответственный: '.$model->res_person.'. Контроль:'
            .$model->super_person.' +79873242404, +74957877667 доб. 7377.'; 
    }
    //Закрытие
    elseif ($ref_type_steps_id === 3) {
        $this->title = 'Закрытие инцидента № '.$incident->inc_number;
        $text = $this->title. '. Завершение: '.$model->clock.'. Продолжительность: '.mb_substr($incident->duration, 0, 5)
            .'. Приоритет: '.$model->refImportance->name.'. '.$model->message
            .'. Ответственный: '.$info['res_person'].'. Контроль:'
            .$model->super_person.' +79873242404, +74957877667 доб. 7377.';
    }
}
//Инцидент на ВОЛС ООО Единство
if (($incident->ref_company_id === 2)||($incident->ref_company_id ===3)) {
    //Открытие
    if ($ref_type_steps_id === 1) {
        $this->title = 'Открытие инцидента на ВОЛС Единство № '.$incident->inc_number;
        $text = $this->title . '. Начало: '.$model->clock
            .'. Приоритет: '.$model->refImportance->name. '. '.$model->message
            .'. Ответственный: '.$model->res_person.'. Контроль:'
            .$model->super_person.' +79873242404, +74957877667 доб. 7377.';
    }
    //Дополнение
    elseif ($ref_type_steps_id === 2) {
        $this->title = 'Дополнение по инциденту на ВОЛС Единство № '.$incident->inc_number;
        $text = $this->title. '. Начало: '.$starting_time_inc
            .'. Приоритет: ' .$model->refImportance->name.'. '.$model->message
            .'. Ответственный: '.$model->res_person.'. Контроль:'
            .$model->super_person.' +79873242404, +74957877667 доб. 7377.'; 
    }
    //Закрытие
    elseif ($ref_type_steps_id === 3) {
        $this->title = 'Закрытие инцидента на ВОЛС Единство № '.$incident->inc_number;
        $text = $this->title. '. Завершение: '.$model->clock.'. Продолжительность: '. mb_substr($incident->duration, 0, 5)
            .'. Приоритет: ' . $model->refImportance->name . '. '.$model->message
            .'. Ответственный: '.$model->res_person.'. Контроль:'
            .$model->super_person.' +79873242404, +74957877667 доб. 7377.';
    }
}
$snapshot['message'][0]['text'] = $text;
$model->snapshot = json_encode($snapshot, JSON_FORCE_OBJECT);
$model->save();
?>


<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Текст рассылки</h3>
    </div>
    <div class="box-body no-padding">
        <table class="table table-condensed">
            <thead>
            </thead>
            <tbody>
                    <td scope="row">
                        <?= $text ?>
                    </td>
            </tbody>
        </table>
    </div>
</div>