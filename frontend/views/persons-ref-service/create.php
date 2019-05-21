<?php

/* @var $this yii\web\View */
/* @var $model frontend\models\PersonsRefRegion */

$this->title = 'Привязать к сервису';
?>
<div class="persons-ref-region-create">
<?=      
    $this->renderAjax('_form', [
        'person_ref_service_model' => $person_ref_service_model,
        'person_ref_service_ref_importance' => $person_ref_service_ref_importance,
        'person_ref_service_ref_region' => $person_ref_service_ref_region,
        'person_ref_service_ref_city' => $person_ref_service_ref_city,
        'person_ref_service_ref_place' => $person_ref_service_ref_place,
        
    ]);  
?>
</div>
