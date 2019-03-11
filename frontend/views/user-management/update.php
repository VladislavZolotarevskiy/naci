<?php

/* @var $this yii\web\View */
/* @var $model frontend\models\TTicket */

$this->title = 'Редактировать заявку';
?>
<div class="tticket-update">

    <?= $this->render('_updateform', [
        'model' => $model,
    ]) ?>

</div>
