<?php

/* @var $this yii\web\View */
/* @var $model frontend\models\PersonsRefCity */

$this->title = 'Привязать к площадке';
?>
<div class="persons-ref-place-create">
<?= $this->render('_form', [
    'model' => $model,
    'person_id' => $person_id,
]);?>
</div>
`