<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\RefContactType */

$this->title = 'Добавить тип контактов';
?>
<div class="ref-contact-type-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
