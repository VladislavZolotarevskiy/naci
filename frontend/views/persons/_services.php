<?php
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
?>


<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Сервисы</h3>
    </div>
    <div class="box-body no-padding">
        <?php Pjax::begin([
            'id' => 'contacts'])?>
        <?= GridView::widget([
            'tableOptions' => [
                'class' => 'table table-striped table-bordered no-margin no-border'
            ],
            'layout'=>"{items}",
            'dataProvider' => $serviceDataProvider,
            'columns' => [
                [
                'attribute' => 'refService.name',
                'label' => 'Сервис'
                ],
                [
                'attribute' => 'personsRefServiceRefImportances.name',
                'label' => 'Приоритет'
                ],
                [
                'attribute' => 'refRegion.name',
                'label' => 'Регион'
                ],
                [
                'attribute' => 'refPlace.name',
                'label' => 'Площадка'
                ],
                [
                'attribute' => 'refCity.name',
                'label' => 'Город'
                ],
                ['class' => 'yii\grid\ActionColumn',
                    'headerOptions' => ['width' => '50'],
                    'template' => '{update} {delete}',
                    'buttons' => [
                        'update' => function ($action, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span> ' . 
                                '', ['/persons-ref-service/update', 'id' => $key], [
                                'data-toggle' => 'modal',
                                'data-target' => '#modal-service-update',
                                'onclick' => 
                                    "$('#modal-service-update .modal-dialog .modal-content .modal-body').load($(this).attr('href'))",
                                ]
                            );   
                        },
                        'delete' => function ($action, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span> ' . 
                                '', ['/persons-ref-service/delete', 'id' => $key], [
                                    'data-method' => 'post',
                                    'data-confirm' => 'Удалить контакт?'
                                ]);    
                        },        
                    ]    
                ],
            ],                    
            ]) ?>
    </div>
    <div class="box-footer">
        <?= Html::a('<span class="fa fa-plus"></span> ' .
            '', ['/persons-ref-service/create','person_id' => $person_id], [
            'id' => 'contact-add',
            'data-toggle' => 'modal',
            'data-target' => '#modal-service-create',
            'onclick' => 
            "$('#modal-service-create .modal-dialog .modal-content .modal-body').load($(this).attr('href'))",
            ]) ?>
    </div>
</div>
        <?php Pjax::end()?>