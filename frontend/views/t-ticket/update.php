<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\TTicket */

$this->title = 'Update Tticket: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ttickets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tticket-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
