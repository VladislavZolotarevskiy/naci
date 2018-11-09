<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\RefCityType */

$this->title = 'Редактировать тип города: ' . $model->name;
?>
<div class="ref-city-type-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
