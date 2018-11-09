<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\RefRegion */

$this->title = 'Редактировать регион: ' . $model->name;
?>
<div class="ref-region-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
