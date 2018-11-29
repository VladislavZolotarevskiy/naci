<?php
use yii\helpers\Html;
use yii\helpers\Url; ?>

<div class="management">
<?= Html::a('Назад', Url::toRoute('index'), ['class' => 'btn btn-danger'])?>
    <?php if($status == 1):?>
        <?= Html::a('Открытие', [
            '/incident-steps/create',
            'incident_id' => $incident_id,
            'ref_type_steps_id' => $status], [
                'class' => 'btn btn-success'])?>
    <div class="row">
        <div class="col-md-3 col-sm-12 col-xs-12" style="padding:15px">
            <div class="callout callout-info">
                <div class="status">
                    <h4>Статус инцидента</h4>
                    <p>Создан</p>
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
        <div class="row">
            <div class="col-md-4 col-sm-12 col-xs-12" style="padding:15px">
                <div class="callout callout-success">
                    <h4>Статус инцидента</h4>
                    <p>Открыт</p>
                </div>
            </div>
        </div>
    <?php elseif ($status == 3): ?>
        <div class="row">
            <div class="col-md-5 col-sm-12 col-xs-12" style="padding:15px">
                <div class="callout callout-danger">
                    <h4>Статус инцидента</h4>
                <p>Закрыт</p>
                </div>
            </div>
        </div>
    <?php endif ?>
  </div>