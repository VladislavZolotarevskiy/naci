<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\IncidentRefPlace */

$this->title = 'Update Incident Ref Place: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Incident Ref Places', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="incident-ref-place-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
