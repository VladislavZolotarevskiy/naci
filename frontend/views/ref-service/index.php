<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\RefServiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сервисы';
?>
<div class="ref-service-index">
    
    <?php Pjax::begin(); ?>
   
    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout'=>"{items}\n{pager}",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            [
                'attribute' => 'name',
                'label' => 'Наименование',
            ],
            [
                'attribute' => 'companyRefServices.name',
                'label' => 'Компания',],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
