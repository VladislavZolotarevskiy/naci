<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\RefPlace */

$this->title = 'Редактировать площадку: ' . $model->name;
?>
<div class="ref-place-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
