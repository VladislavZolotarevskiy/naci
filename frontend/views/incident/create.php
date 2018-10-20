<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Incident */

$this->title = 'Создать инцидент';
?>
<div class="incident-create">
    
        <?= $this->render('_form', [
        'model_incident' => $model_incident,
        'model_incident_ref_city' => $model_incident_ref_city,   
        'model_incident_ref_region' => $model_incident_ref_region,   
        'model_incident_ref_place' => $model_incident_ref_place,   
        'model_incident_ref_service' => $model_incident_ref_service,   
        ]) ?>

</div>
