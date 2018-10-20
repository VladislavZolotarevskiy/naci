<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\RefTypeTt */

$this->title = 'Create Ref Type Tt';
$this->params['breadcrumbs'][] = ['label' => 'Ref Type Tts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-type-tt-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
