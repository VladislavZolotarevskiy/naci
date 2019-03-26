<?php

/* @var $this yii\web\View */
/* @var $model frontend\models\TTicket */

$this->title = 'Изменить данные';
?>
<div class="user-self-update">

    <?= $this->render('_selfupdateform', [
        'model' => $model,
    ]) ?>

</div>
