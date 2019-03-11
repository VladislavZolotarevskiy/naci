<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel common\models\RefCitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
?>
<?= Modal::widget([
    'id' => 'user_create',
    'header' => Html::tag('h4', Html::encode('Создать пользователя'),['class' => 'username'])
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
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
