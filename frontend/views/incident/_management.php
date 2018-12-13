<?php
use yii\helpers\Html;
use yii\helpers\Url; ?>

<div class="management">
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-6">
            <?= Html::a('Назад', Url::toRoute('index'), ['class' => 'btn btn-danger', 'title' => 'Вернуться к списку инцидентов'])?>
            <?php if($status == 1):?>
                <?= Html::a('Открытие', [
                    '/incident-steps/create',
                    'incident_id' => $incident_id,
                    'ref_type_steps_id' => $status], [
                     'class' => 'btn btn-success'])?>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="row">
                <div class="col-md-3 col-sm-12 col-xs-12" style="padding-bottom:15px;padding-right:15px">
                    <div class="callout callout-info">
                        <div class="status">
                            <h4>Статус инцидента</h4>
                            <p>Создан</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
            <?php elseif ($status == 2): ?>
                <?= Html::a('Дополнение', [
                    '/incident-steps/create',
                    'incident_id' => $incident_id,
                    'ref_type_steps_id' => $status], [
                        'class' => 'btn btn-primary']) ?>
                <?= Html::a('Закрытие', [
                    '/incident-steps/create',
                    'incident_id' => $incident_id,
                    'ref_type_steps_id' => $status+1], [
                        'class' => 'btn btn-danger'])?>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="row">
                <div class="col-md-offset-4 col-sm-offset-4 col-xs-offset-4" style="padding-bottom:15px;padding-right:15px">
                    <div class="callout callout-success no-margin">
                        <h4>Статус инцидента</h4>
                        <p>Открыт</p>
                    </div>
                </div>
            </div>
        </div>
            <?php elseif ($status == 3): ?>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="row">
                    <div class="col-md-offset-4 col-sm-offset-4 col-xs-offset-4" style="padding-bottom:15px;padding-right:15px">
                        <div class="callout callout-danger">
                            <h4>Статус инцидента</h4>
                        <p>Закрыт</p>
                        </div>
                    </div>
                </div>
        </div>    
            <?php endif ?>
    </div>
</div>