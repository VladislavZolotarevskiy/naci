<?php

/* @var $this yii\web\View */
/* @var $model frontend\models\PersonsRefServiceRefImportance */

$this->title = 'Добавить приоритет';
?>
<div class="persons-ref-service-ref-importance-create">    
<?= $this->render('_form', [
    'model' => $model,
    'person_ref_service_id' => $person_ref_service_id,
    ]); 
?>

</div>
