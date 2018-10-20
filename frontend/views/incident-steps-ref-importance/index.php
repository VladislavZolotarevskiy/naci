<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\IncidentStepsRefImportanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Incident Steps Ref Importances';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incident-steps-ref-importance-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Incident Steps Ref Importance', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'incident_steps_id',
            'ref_importance_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
