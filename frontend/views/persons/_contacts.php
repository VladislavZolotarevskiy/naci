<?php
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
?>


<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Контакты</h3>
    </div>
    <div class="box-body no-padding">
        <?php Pjax::begin([
            'id' => 'contacts'])?>
        <?= GridView::widget([
            'tableOptions' => [
                'class' => 'table table-striped table-bordered no-margin no-border'
            ],
            'layout'=>"{items}",
            'dataProvider' => $contactsDataProvider,
            'columns' => [
                [
                'attribute' => 'refContactType.name',
                'label' => 'Тип'
                ],
                'name',
                ['class' => 'yii\grid\ActionColumn',
                    'headerOptions' => ['width' => '50'],
                    'template' => '{update} {delete}',
                    'buttons' => [
                        'update' => function ($action, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span> ' . 
                                '', ['/contacts/update', 'id' => $key], [
                                'data-toggle' => 'modal',
                                'data-target' => '#modal-contact-update',
                                'onclick' => 
                                    "$('#modal-contact-update .modal-dialog .modal-content .modal-body').load($(this).attr('href'))",
                                ]
                            );   
                        },
                        'delete' => function ($action, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span> ' . 
                                '', ['/contacts/delete', 'id' => $key], [
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
            '', ['/contacts/create','person_id' => $person_id], [
            'id' => 'contact-add',
            'data-toggle' => 'modal',
            'data-target' => '#modal-contact-create',
            'onclick' => 
            "$('#modal-contact-create .modal-dialog .modal-content .modal-body').load($(this).attr('href'))",
            ]) ?>
    </div>
</div>
        <?php Pjax::end()?>