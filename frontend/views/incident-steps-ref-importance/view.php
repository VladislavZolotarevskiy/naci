<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\IncidentStepsRefImportance */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Incident Steps Ref Importances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incident-steps-ref-importance-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'incident_steps_id',
            'ref_importance_id',
        ],
    ]) ?>

</div>
