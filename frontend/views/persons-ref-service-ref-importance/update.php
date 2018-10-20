<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\PersonsRefServiceRefImportance */

$this->title = 'Update Persons Ref Service Ref Importance: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Persons Ref Service Ref Importances', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="persons-ref-service-ref-importance-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
