<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\RefContactTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Типы контактов';
?>
<div class="ref-contact-type-index">

    <?php Pjax::begin(); ?>
    
    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout'=>"{items}\n{pager}",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
