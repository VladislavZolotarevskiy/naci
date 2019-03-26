<?php

/* @var $this yii\web\View */
/* @var $model frontend\models\TTicket */

$this->title = 'Создать пользователя';
?>
<div class="user-create">

    <?= $this->render('_createform', [
        'model' => $model
    ]) ?>

</div>
