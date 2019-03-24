<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\RefImportanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Приоритеты';
?>
<div class="ref-importance-index">

    <?php Pjax::begin(); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout'=>"{items}\n{pager}",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'description',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
