<?php 
use frontend\models\IncidentSteps;
use yii\helpers\Html;

$info = (IncidentSteps::incidentStep($incident_steps_id));
$this->title = $info['refTypeSteps']['name'];
$contacts = IncidentSteps::contacts($info['incident_id'],1)
?>
<?php echo $ref_importance_id?>
<div class="incident-send">

    <div class="incident-text">
        
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Текст</h3>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-condensed">
                        <thead>
                        </thead>
                        <tbody>
                            <td scope="row"><?= $info['message']
        .'Ответственный: '.$info['res_person'].'. Контроль:'
        .$info['super_person'].' +79873242404, +74957877667 доб. 7377.' ?></td>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        
    </div>
    <div class="incident-contacts">     
    <h4>Контакты:</h4>
    <div class="row">
        <div class="col-md-2 col-sm-6 col-xs-6">
            <h5><b>ФИО</b></h5>
            <?php foreach (IncidentSteps::contacts($info['incident_id'],
                1)
            as $contact):?><?= $contact['full_name']."<br>";?>
            <?php endforeach;?>
        </div>   
        <div class="col-md-2 col-sm-6 col-xs-6">
            <h5><b>Телефоны</b></h5>
        <textarea class="form-control" rows="10" id="comment"
                  style="padding-top:0px; padding-left:1px"><?php foreach
                      (IncidentSteps::contacts($info['incident_id'],1) 
                          as $contact):
                ?><?= $contact['contact']."\n"?><?php endforeach;?></textarea>
        </div>
        <?php if($info['ref_type_steps_id'] == 1):?>
        <div class="col-md-2 col-sm-6 col-xs-6">
            <h5><b>E-mail</b></h5>
        <textarea class="form-control" rows="10" id="comment"
                  style="padding-top:0px; padding-left:1px"><?php foreach
                      (IncidentSteps::contacts($info['incident_id'],2)
                          as $contact):
                ?><?= $contact['contact']."\n"?><?php endforeach;?></textarea>
        </div>
        <?php endif ?>
    </div>
    <?= Html::a('Вернуться', [
        'incident-steps/update',
        'id' => $incident_steps_id, 
        'ref_type_steps_id' => $info['ref_type_steps_id'],
        ],
            ['class' => 'btn btn-danger']) ?>
    <?= Html::a('Отправить', [
        '/incident/view', 
        'id' => $info['incident_id']],
        ['class' => 'btn btn-primary']) ?>
    </div>
</div>