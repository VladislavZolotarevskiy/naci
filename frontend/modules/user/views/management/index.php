<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel common\models\RefCitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Управление пользователями';
?>
<?= Modal::widget([
    'id' => 'user_create',
    'header' => Html::tag('h4', Html::encode('Создать пользователя'),['class' => 'username'])
])?>
<?= Modal::widget([
    'id' => 'modal-user-update',
    'header' => Html::tag('h4', Html::encode('Редактировать пользователя'),['class' => 'username'])
])?>
<?= Modal::widget([
    'id' => 'modal-user-reset-password',
    'header' => Html::tag('h4', Html::encode('Изменить пароль'),['class' => 'username'])
])?>

<div class="user-management">
       
    <p>
       <?= Html::a('Добавить',Url::toRoute('create'), [
            'class' => 'btn btn-success',
            'data-toggle' => 'modal',
            'data-target' => '#user_create',
            'onclick' => 
                "$('#user_create .modal-dialog .modal-content .modal-body').load($(this).attr('href'))",
            ]
        );?>

    </p>
    <?php Pjax::begin(); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout'=>"{items}\n{pager}",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'ФИО',
                'value' => function($model){
                    return $model->last_name.' '.$model->first_name.' '.$model->middle_name;
                }
            ],
            [
                'attribute' => 'email',
                'label' => 'e-mail'
            ],
            [
                'attribute' => 'username',
                'label' => 'Имя пользователя'
            ],
            [
                'attribute' => 'admin',
                'label' => 'Администратор',
                'value' => function ($model){
                    if ($model->admin == 1) {
                        return 'Да';
                    }
                    return 'Нет';
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'class' => 'yii\grid\ActionColumn',
                    'headerOptions' => ['width' => '50'],
                    'template' => '{update} {delete} {password}',
                    'buttons' => [
                        'update' => function ($action, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span> ' . 
                                '', Url::toRoute(['update', 'id' => $key]), [
                                'data-toggle' => 'modal',
                                'data-target' => '#modal-user-update',
                                'onclick' => 
                                    "$('#modal-user-update .modal-dialog .modal-content .modal-body').load($(this).attr('href'))",
                                ]
                            );   
                        },
                        'password' => function ($action, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-lock"></span> ' . 
                                '', Url::toRoute(['change-password', 'id' => $key]), [
                                'data-toggle' => 'modal',
                                'data-target' => '#modal-user-reset-password',
                                'onclick' => 
                                    "$('#modal-user-reset-password .modal-dialog .modal-content .modal-body').load($(this).attr('href'))",
                                ]
                            );   
                        },
                        'delete' => function ($action, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span> ' . 
                                '', Url::toRoute(['delete', 'id' => $key]), [
                                    'data-method' => 'post',
                                    'data-confirm' => 'Удалить контакт?'
                                ]);    
                        },        
                    ]    
                ],
            ],
    ]);?>
    <?php Pjax::end(); ?>
</div>