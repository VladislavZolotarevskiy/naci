<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\IncidentStepsRefImportance */

$this->title = 'Update Incident Steps Ref Importance: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Incident Steps Ref Importances', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="incident-steps-ref-importance-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
