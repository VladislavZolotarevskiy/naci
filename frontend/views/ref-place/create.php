<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\RefPlace */

$this->title = 'Добавить площадку';
?>
<div class="ref-place-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
