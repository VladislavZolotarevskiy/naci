<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\RefCity */

$this->title = 'Добавить населённый пункт';
?>
<div class="ref-city-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
