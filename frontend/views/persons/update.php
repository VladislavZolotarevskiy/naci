<?php


/* @var $this yii\web\View */
/* @var $model frontend\models\Persons */

$this->title = 'Изменить ФИО';
?>
<div class="persons-update">

    <?= $this->render('_form', [
        'model' => $model,
        'id' => $id,
    ]) ?>

</div>
