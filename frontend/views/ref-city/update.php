<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\RefCity */

$this->title = 'Редактировать населённый пункт:' . $model->name;
?>
<div class="ref-city-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
