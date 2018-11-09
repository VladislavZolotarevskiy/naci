<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\RefService */

$this->title = 'Редактировать сервис: ' . $model->name;
?>
<div class="ref-service-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
