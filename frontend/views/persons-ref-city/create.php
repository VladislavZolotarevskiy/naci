<?php

/* @var $this yii\web\View */
/* @var $model frontend\models\PersonsRefCity */

$this->title = 'Привязать к населённому пункту';?>
<div class="persons-ref-city-create">
<?= $this->render('_form', [
    'model' => $model,
    'person_id' => $person_id,
    ]);?>
</div>
