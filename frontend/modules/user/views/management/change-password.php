<?php

/* @var $this yii\web\View */
/* @var $model frontend\models\TTicket */

$this->title = 'Изменить пароль';
?>
<div class="user-change-password">

    <?= $this->render('_changeform', [
        'model' => $model
    ]) ?>

</div>
