<?php

/* @var $this yii\web\View */
/* @var $model frontend\models\PersonsRefRegion */

$this->title = 'Привязать к региону';
?>
<div class="persons-ref-region-create">

<?=
$this->render('_form', [
    'model' => $model,
    'person_id' => $person_id,
]);?>
</div>
