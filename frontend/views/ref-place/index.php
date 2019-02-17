<?php

use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel common\models\RefPlaceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Площадки';
?>
<div class="ref-place-index">

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout'=>"{items}\n{pager}",
        'columns' => [
            'name',
            [
                'attribute' => 'refCity.name',
                'label' => 'Населённый пункт'
            ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',
        ],
        ],
    ]); ?>
</div>