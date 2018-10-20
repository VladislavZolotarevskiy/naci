<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\IncidentStepsRefImportance */

$this->title = 'Create Incident Steps Ref Importance';
$this->params['breadcrumbs'][] = ['label' => 'Incident Steps Ref Importances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incident-steps-ref-importance-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
