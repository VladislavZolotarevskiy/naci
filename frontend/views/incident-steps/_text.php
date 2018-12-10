<?php
use frontend\models\Incident;
use frontend\models\IncidentSteps;
$starting_time_inc = IncidentSteps::needlessTime($info['incident_id'], 1)['clock'];?>

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
                <?php if ($ref_type_steps_id ==1):?>
                <?php $this->title = 'Открытие инцидента № '.$inc_number?>
                <?= $this->title . '. Начало: '.$info['clock']
                .'. Приоритет: '. $info['refImportance']['name']. '. '.$info['message']
                .'. Ответственный: '.$info['res_person'].'. Контроль:'
                .$info['super_person'].' +79873242404, +74957877667 доб. 7377.' ?>

                <?php elseif ($ref_type_steps_id ==2):?>
                <?php $this->title = 'Дополнение по инциденту № '.$inc_number?>
                <?= $this->title. '. Начало: '.$starting_time_inc
                .'. Приоритет: ' . $info['refImportance']['name'] . '. '. $info['message']
                .'Ответственный: '.$info['res_person'].'. Контроль:'
                .$info['super_person'].' +79873242404, +74957877667 доб. 7377.' ?>

                <?php else:?>
                <?php $this->title = 'Закрытие инцидента № '.$inc_number;
                $duration = mb_substr(Incident::findOne($info['incident_id'])['duration'], 0, 5)?>
                <?= $this->title. '. Завершение: '.$info['clock'].'. Продолжительность: '. $duration
                .'. Приоритет: ' . $info['refImportance']['name'] . '. '. $info['message']
                .'Ответственный: '.$info['res_person'].'. Контроль:'
                .$info['super_person'].' +79873242404, +74957877667 доб. 7377.' ?>
                <?php endif ?>
                </td>
            </tbody>
        </table>
    </div>
</div>