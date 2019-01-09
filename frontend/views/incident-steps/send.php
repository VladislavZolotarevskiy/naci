<?php
use frontend\models\IncidentSteps;
use yii\helpers\Html;
use yii\helpers\Url;
Url::remember(['send',
    'incident_steps_id' => $incident_steps_id,
    'ref_importance_id' => $ref_importance_id,
    'inc_number' => $inc_number],'incident-steps-send');
$info = (IncidentSteps::incidentStep($incident_steps_id));
?> 
<pre>
    <?php print_r($model->snapshot)?>
</pre>
<?= $this->render ('_modal')?>
<div class="incident-send">
    <div class="incident-text">
        <?= $this->render ('_text', [
            'ref_type_steps_id'=> $info['refTypeSteps']['id'],
            'model' => $model,
            'inc_number' => $inc_number,
        ])?>
    </div>
    <div class="incident-contacts">
        <h4>Контакты рассылки</h4>
        <?php if ($ref_importance_id == 4):?>
        <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="contacts-phone">
                <?= $this->render('_contacts-phone', [
                    'contacts' => $contacts,
                    'incident_steps_id' => $incident_steps_id
                ])?>
                </div>     
            </div>    
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="contacts-mail">
                <?= $this->render('_contacts-mail', [
                    'contacts' => $contacts,
                    'incident_steps_id' => $incident_steps_id
                ])?>
                </div>    
            </div>
        </div>
        <?php else :?>
        <div class="col-md-12 col-sm-12 col-xs-12 no-padding" >
            <div class="contacts-phone">
            <?= $this->render('_contacts-phone', [
                'contacts' => $contacts,
                'incident_steps_id' => $incident_steps_id
            ])?>
            </div>
        </div>    
        <?php endif?>
    </div>
    <div class="form-group">
        <?= Html::a('Вернуться', [
            'incident-steps/update',
            'id' => $incident_steps_id,
            ],
                ['class' => 'btn btn-danger']) ?>
        <?= Html::a('Отправить', [
            'send',
            'ref_importance_id' => $ref_importance_id,
            'incident_steps_id' => $incident_steps_id,
            'inc_number' => $inc_number],
            ['class' => 'btn btn-primary',
             'data' => [
                'method' => 'post',]]) ?>
    </div>
</div>