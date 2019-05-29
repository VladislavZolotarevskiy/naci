<?php

/* @var $this yii\web\View */
/* @var $model frontend\models\PersonsRefRegion */

$this->title = 'Привязать к сервису';
?>
<div class="persons-ref-region-create">
<?=      
    $this->renderAjax('_form', [
        'person_ref_service_model' => $person_ref_service_model,
        'person_ref_service_ref_region' => $person_ref_service_ref_region,
        'person_ref_service_ref_city' => $person_ref_service_ref_city,
        'person_ref_service_ref_place' => $person_ref_service_ref_place,
        'fake_company_model' => $fake_company_model,
        'fake_importance' => $fake_importance,
        'person_id' => $person_id,
    ]);  
?>
</div>
