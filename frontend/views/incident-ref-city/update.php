<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\IncidentRefCity */

$this->title = 'Update Incident Ref City: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Incident Ref Cities', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="incident-ref-city-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
