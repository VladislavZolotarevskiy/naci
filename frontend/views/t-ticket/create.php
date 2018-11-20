<?php

/* @var $this yii\web\View */
/* @var $model frontend\models\TTicket */

$this->title = 'Добавить заявку';
?>
<div class="tticket-create">

    <?= $this->render('_createform', [
        'model' => $model,
        'incident_id' => $incident_id,
    ]) ?>

</div>
