<?php

/* @var $this yii\web\View */
/* @var $model frontend\models\TTicket */

$this->title = 'Редактировать пользователя';
?>
<div class="user-update">

    <?= $this->render('_updateform', [
        'model' => $model,
    ]) ?>

</div>
