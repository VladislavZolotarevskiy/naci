<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\RefContactType */

$this->title = 'Редактировать тип контактов: ' . $model->name;
?>
<div class="ref-contact-type-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
