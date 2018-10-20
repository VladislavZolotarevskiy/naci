<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\RefService */

$this->title = 'Добавить сервис';
?>
<div class="ref-service-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
