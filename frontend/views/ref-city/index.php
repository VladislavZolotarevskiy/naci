<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\RefCitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Населённые пункты';
?>
<div class="ref-city-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            ['attribute' => 'refCityType.name',
            'label' => 'Тип'],
            ['class' => 'yii\grid\ActionColumn',
		'template' => '{update} {delete}',
	    ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
