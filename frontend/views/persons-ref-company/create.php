<?php

/* @var $this yii\web\View */
/* @var $model frontend\models\PersonsRefCompany */

$this->title = 'Привязать к компании';
?>
<div class="persons-ref-company-create">
<?=
$this->render('_form', [
    'model' => $model,
    'person_id' => $person_id,
]);?>
</div>
