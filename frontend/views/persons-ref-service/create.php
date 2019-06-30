<?php

/* @var $this yii\web\View */
/* @var $model frontend\models\PersonsRefRegion */

$this->title = 'Привязать к сервису';
?>
<div class="persons-ref-region-create">
<?=      
    $this->renderAjax('_form', [
        'person_ref_service' => $person_ref_service,
        'fake_company' => $fake_company,
        'fake_importance' => $fake_importance,
        'person_id' => $person_id,
    ]);  
?>
</div>
