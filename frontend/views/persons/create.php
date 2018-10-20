<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Persons */

$this->title = 'Добавить сотрудника';
?>
<div class="persons-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
