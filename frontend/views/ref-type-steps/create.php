<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\RefTypeSteps */

$this->title = 'Create Ref Type Steps';
$this->params['breadcrumbs'][] = ['label' => 'Ref Type Steps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-type-steps-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
