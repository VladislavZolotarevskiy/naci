<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\PersonsRefCity */

$this->title = 'Update Persons Ref City: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Persons Ref Cities', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="persons-ref-city-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
