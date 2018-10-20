<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\TTicket */

$this->title = 'Добавить заявку';
?>
<div class="tticket-create">

    <?= $this->render('_form', [
        'model' => $model,
        'incident_id' => $incident_id,
    ]) ?>

</div>
