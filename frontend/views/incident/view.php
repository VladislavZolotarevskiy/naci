<?php 
use yii\helpers\Html;
use yii\helpers\Url;

Url::remember(['view', 'id'=> $model->id],'incident-view');
$status = $model->status;
$this->title = 'Инцидент № '.$model->inc_number;
$prev_date = null;
?>

<?=$this->render('_modal',[
    'status' => $status
])?>

<div class="incident-view">
    <?= $this->render('_management',[
        'incident_id' => $model->id,
        'status' => $status,
        'model' => $model
    ])?>

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
    <div class="col-md-6 col-sm-12 col-xs-12">
        <?= $this->render('_t-ticket',[
            'tticketDataProvider' => $tticketDataProvider,
            'inc_status' => $status,
            'incident_id' => $model->id
            ])?>
    </div>
   

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
                   'inc_number' => $model->inc_number], [
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
