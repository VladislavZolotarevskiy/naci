<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Incident */

$this->title = 'Update Incident: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Incidents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="incident-update">

    <h1><?= Html::encode($this->title) ?></h1>


</div>
