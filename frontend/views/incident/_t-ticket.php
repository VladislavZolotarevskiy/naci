<?php
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Заявки</h3>
    </div>
    <div class="box-body no-padding">
        <?php Pjax::begin([
            'id' => 'tickets'])?>
        <?= GridView::widget([
            'layout'=>"{items}",
            'dataProvider' => $tticketDataProvider,
            'columns' => [
                'refTypeTt.name',
                't_number',
                ['class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {delete}',
                    'buttons' => [
                        'update' => function ($action, $model, $key) {
                            if ($model->incident->status == 3) {
                                return false;
                            }
                            else {
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span> ' . 
                                    '', Url::toRoute(['./t-ticket/update', 'id' => $key]), [
                                    'data-toggle' => 'modal',
                                    'data-target' => '#modal-ticket-update',
                                    'onclick' => 
                                        "$('#modal-ticket-update .modal-dialog .modal-content .modal-body').load($(this).attr('href'))",
                                    ]
                                );
                            }    
                        },
                        'delete' => function ($action, $model, $key) {
                            if ($model->incident->status == 3) {
                                return false;
                            }
                            else {
                                return Html::a('<span class="glyphicon glyphicon-trash"></span> ' . 
                                    '', Url::toRoute(['./t-ticket/delete', 'id' => $key]), [
                                        'data-method' => 'post',
                                        'data-confirm' => 'Удалить заявку?'
                                    ]);
                            }    
                        },        
                    ]    
                ],
            ],                    
            ]) ?>
    </div>
    <?php if ($inc_status !== 3):?>
    <div class="box-footer">
        <?= Html::a('<span class="fa fa-plus"></span> ' .
            'Добавить', ['/t-ticket/create','incident_id' => $incident_id], [
            'id' => 'tticket-add',
            'data-toggle' => 'modal',
            'data-target' => '#modal-ticket-create',
            'class' => 'btn btn-primary',
            'onclick' => 
            "$('#modal-ticket-create .modal-dialog .modal-content .modal-body').load($(this).attr('href'))",
            ]) ?>
    </div>
    <?php endif?>
</div>
        <?php Pjax::end()?>