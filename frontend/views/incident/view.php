<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use frontend\models\TTicket;
/* @var $this yii\web\View */
/* @var $model frontend\models\Incident */
$status = $model->status;
$this->title = 'Инцидент № '.$model->inc_number;
$prev_date = null;
?>
<?= Modal::widget([
    'id' => 'contacts',
    'header' => Html::tag('h4', Html::encode('Контакты рассылки'),['class' => 'username']),
]);?>
<?= Modal::widget([
    'id' => 'mymodel-win',
    'header' => Html::tag('h4', Html::encode('Добавить заявку'),['class' => 'username']),
]);?>
<div class="incident-view">
  <div class="management">
    <?= Html::a('Назад', ['./incident'], ['class' => 'btn btn-danger'])?>
    <?php if($status == 1):?>
    <?= Html::a('Открытие', [
      '/incident-steps/create',
      'incident_id' => $model->id,
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
      'incident_id' => $model->id,
      'ref_type_steps_id' => $status], [
      'class' => 'btn btn-primary']) ?>
    <?= Html::a('Закрытие', [
      '/incident-steps/create',
      'incident_id' => $model->id,
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

  <div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Затронуты</h3>
        </div>
        <div class="box-body no-padding">
        <!--Cities-->
        <div class="col-md-3 col-sm-12 col-xs-12 no-padding">
          <table class="table table-condensed">
            <thead>
              <th scope="col", class="col-md-3">Города</th>
            </thead>
            <tbody>
              <?php foreach ($model->cityList(['incident_id' => $model->id]) as $item): ?>
                <tr>
                  <td scope="row"><?= $item['refCity']['name']   ?></td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
        <!--Regions-->
        <div class="col-md-3 col-sm-12 col-xs-12 no-padding">
          <table class="table table-condensed">
            <thead>
              <th scope="col", class="col-md-3">Регионы</th>
            </thead>
            <tbody>
              <?php foreach ($model->regionList(['incident_id' => $model->id]) as $item):?>
                <tr>
                  <td scope="row"><?= $item['refRegion']['name']   ?></td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
        <!--Places-->
        <div class="col-md-3 col-sm-12 col-xs-12 no-padding">
          <table class="table table-condensed">
            <thead>
              <th scope="col", class="col-md-3">Площадки</th>
            </thead>
            <tbody>
              <?php foreach ($model->placeList([
                'incident_id' => $model->id]) as $item):?>
                <tr>
                  <td scope="row"><?= $item['refPlace']['name']   ?></td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
        <!--Services-->
        <div class="col-md-3 col-sm-12 col-xs-12 no-padding">
          <table class="table table-condensed">
            <thead>
              <th scope="col", class="col-md-3">Сервисы</th>
            </thead>
            <tbody>
              <?php foreach ($model->serviceList([
                'incident_id' => $model->id]) as $item):?>
                <tr>
                  <td scope="row"><?= $item['refService']['name']   ?></td>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
        </div>
      </div>
    </div>
    <?php yii\widgets\Pjax::begin([
        'timeout' => 99999,
        'id' => 'tickets'])?>
    <div class="col-md-6 col-sm-12 col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Заявки</h3>
        </div>
        <div class="box-body no-padding">
            <table class="table table-condensed">
            <thead>
                <tr>
                    <th scope="col", class="col-md-0"></th>
                    <th scope="col", class="col-md-6">Тип</th>
                    <th scope="col", class="col-md-6">Номер</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach (TTicket::ticketList([
                'incident_id' => $model->id]) as $item):?>
                <tr>
                    <td scope="row">
                        <?=
                            Html::a('', [
                            './t-ticket/delete',
                            'id' => $item['id'],
                            'incident_id' => $model->id], [
                            'class' => "fa fa-minus text-red",
                            'title' => "Удалить заявку",
                            'data-confirm' => "Удалить заявку?",
                            'data-method' => "post"])
                        ?>
                    </td>
                    <td scope="row">
                        <?= $item['refTypeTt']['name']?>
                    </td>
                    <td scope="row">
                        <?= $item['t_number']?>
                    </td>
                </tr>

              <?php endforeach ?>
                <tr>
                    <td scope="row">
                        <?= Html::a('', [
                            './t-ticket/create',
                            'incident_id' => $model->id], [
                            'data-toggle' => 'modal',
                            'data-target' => '#mymodel-win',
                            'class' => 'fa fa-plus text-blue',
                            'title' => "Добавить заявку",
                            'onclick' => "$('#mymodel-win .modal-dialog .modal-content .modal-body').load($(this).attr('href'));",
                            ]) ?></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
          </table>
        </div>
        </div>
      </div>
    <?php yii\widgets\Pjax::end()?>

    </div>
   <ul class="timeline">
    <?php $current_date = date('Y-m-d')?>
    <?php foreach ($model->incidentSteps(
      ['incident_id' => $model->id]) as $step): ?>
      <!-- timeline time label -->
      <?php $date_of_inc = mb_substr($step['clock'], 0, 10)?>
      <?php if ($date_of_inc !== $prev_date):?>
        <li class="time-label">
          <span class="bg-blue">
            <?= $date_of_inc ?>
          </span>
        </li>
      <?php endif?>
      <!-- /.timeline-label -->
      <!-- timeline item -->
      <li>
        <!-- timeline icon -->
        <?php if (($step['no_send'] == 0)||($step['no_send'] == 1)):?>
        <i class="fa fa-envelope bg-red"></a></i>
        <?php else :?>
        <i class="fa fa-envelope bg-blue"></a></i>
        <?php endif ?>
        <div class="timeline-item">
          <span class="time"><i class="fa fa-clock-o"></i> <?= mb_substr($step['clock'], 11, 5)?></span>
          <h3 class="timeline-header">
              <a href="../incident-steps/view?id=<?=$step['id']?>">
                <?= $step['type']?>
              </a>
              <a class="btn btn-primary btn-xs"
                 style="float: right;">Приоритет: <?= $step['importance']?>
              </a>
          </h3>
          <div class="timeline-body">
            <?= $step['message']?><br>
            <?= $prev_date ?><br>
          </div>
          <div class="timeline-footer">
            <?php if ($step['no_send'] == 1):?>
              <?= Html::a('Без рассылки', [
                   '',], [
                   'class' => 'btn btn-danger btn-xs'
              ]) ?>
            <?php elseif ($step['no_send'] == 0):?>
              <?= Html::a('Выполнить рассылку', [
                   './incident-steps/send',
                   'incident_steps_id' => $step['id'],
                   'ref_importance_id' => $step['importance_id'],
                   'inc_number' => $model->inc_number,
                   'ref_company_id' => $model->ref_company_id], [
                   'class' => 'btn btn-danger btn-xs',
                   'title' => "Выполнить рассылку",
              ]) ?>
            <?php else :?>
              <?= Html::a('Контакты рассылки', [
                  './incident-steps/snapshot',
                  'incident_steps_id' => $step['id'],
                  'ref_importance_id' => $step['importance_id'],], [
                  'data-toggle' => 'modal',
                  'data-target' => '#contacts',
                  'class' => 'btn btn-primary btn-xs',
                  'onclick' => "$('#contacts .modal-dialog .modal-content .modal-body').load($(this).attr('href'));",
                  ]) ?>
            <?php endif ?>
          </div>
        </div>
      </li>
      <!-- END timeline item -->
      <?php $prev_date = mb_substr($step['clock'], 0, 10) ?>
    <?php endforeach ?>
  </ul>
</div>
