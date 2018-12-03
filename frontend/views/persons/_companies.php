<?php
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
?>


<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Компания</h3>
    </div>
    <div class="box-body no-padding">
        <?php Pjax::begin([
            'id' => 'companies'])?>
        <?= GridView::widget([
            'tableOptions' => [
                'class' => 'table table-striped table-bordered no-margin no-border'
            ],
            'layout'=>"{items}",
            'dataProvider' => $companiesDataProvider,
            'columns' => [
                'refCompany.name',
                ['class' => 'yii\grid\ActionColumn',
                    'headerOptions' => ['width' => '50'],
                    'template' => '{update} {delete}',
                    'buttons' => [
                        'update' => function ($action, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span> ' . 
                                '', Url::toRoute(['./persons-ref-company/update', 'id' => $key]), [
                                'data-toggle' => 'modal',
                                'data-target' => '#modal-company-update',
                                'onclick' => 
                                    "$('#modal-company-update .modal-dialog .modal-content .modal-body').load($(this).attr('href'))",
                                ]
                            );   
                        },
                        'delete' => function ($action, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span> ' . 
                                '', Url::toRoute(['./persons-ref-company/delete', 'id' => $key]), [
                                    'data-method' => 'post',
                                    'data-confirm' => 'Отвязать от компании?'
                                ]);    
                        },        
                    ]    
                ],
            ],                    
            ]) ?>
    </div>
    <div class="box-footer">
        <?= Html::a('<span class="fa fa-plus"></span> ' .
            '', Url::toRoute(['./persons-ref-company/create','person_id' => $person_id]), [
            'id' => 'contact-add',
            'data-toggle' => 'modal',
            'data-target' => '#modal-company-create',
            'onclick' => 
            "$('#modal-company-create .modal-dialog .modal-content .modal-body').load($(this).attr('href'))",
            ]) ?>
    </div>
</div>
        <?php Pjax::end()?>