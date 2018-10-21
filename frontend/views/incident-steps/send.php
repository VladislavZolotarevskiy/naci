<?php
use frontend\models\IncidentSteps;
use frontend\models\Incident;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$info = (IncidentSteps::incidentStep($incident_steps_id));
$starting_time_inc = IncidentSteps::needlessTime($info['incident_id'], 1)['clock'];
$ref_type_steps_id = $info['refTypeSteps']['id'];
$contacts_mail = IncidentSteps::contacts($info['incident_id'],
        $ref_importance_id,2);
$contacts_phone = IncidentSteps::contacts($info['incident_id'],
        $ref_importance_id,1);
?>

<?= $son_of_a_dog ?>
<div class="incident-send">

    <div class="incident-text">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Текст рассылки</h3>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
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
                <!-- /.box-body -->
            </div>

    </div>
    <div class="incident-contacts">

    <?php $form = ActiveForm::begin()?>
    <h4>Контакты:</h4>
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-6">
            <h5 style="margin-top:0;"><b>ФИО</b></h5>
            <?php if($contacts_phone !== null):?>
            <?php foreach ($contacts_phone as $contact):?>
                <?= $contact['full_name']."<br>";?>
            <?php endforeach;?>
            <?php endif ?>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-6">
        <?php if ($contacts_phone !== null) {
            $phone = '';
            $rows = 1;
            foreach ($contacts_phone as $contact_phone){
                $phone .= $contact_phone['contact']."\n";
                $rows += 1;
            }
        }?>
        <?php $snapshot->phone = $phone?>
        <?= $form->field($snapshot, 'phone')->textarea([
            'style' => 'padding-top:0; padding-left:1px',
            'rows' => $rows
        ])->label('Телефоны') ?>
        </div>

        <?php if($ref_importance_id == 4):?>
        <div class="col-md-4 col-sm-6 col-xs-6">
            <?php if ($contacts_mail !== null) {
                $mail = '';
                $rows = 1;
                foreach ($contacts_mail as $contact_mail){
                    $mail .= $contact_mail['contact']."\n";
                    $rows += 1;
                }
            }?>
        <?php $snapshot->email = $mail?>
        <?= $form->field($snapshot, 'email')->textarea([
            'style' => 'padding-top:0px; padding-left:1px',
            'rows' => $rows
        ])->label('E-mail') ?>
        </div>
        <?php endif ?>
    </div>
    <?= Html::a('Вернуться', [
        'incident-steps/update',
        'id' => $incident_steps_id,
        ],
            ['class' => 'btn btn-danger']) ?>
    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    <?php ActiveForm::end()?>
    </div>
</div>
