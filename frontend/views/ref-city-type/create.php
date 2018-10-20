<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\RefCityType */

$this->title = 'Добавить тип населённого пункта';
?>
<div class="ref-city-type-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
