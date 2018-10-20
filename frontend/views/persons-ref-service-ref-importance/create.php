<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\PersonsRefServiceRefImportance */

$this->title = 'Добавить приоритет';
?>
<div class="persons-ref-service-ref-importance-create">
    
    <?php if (!$person_ref_service_id == null): ?>
    <?= $this->render('_bond', [
        'model' => $model,
        'person_ref_service_id' => $person_ref_service_id,
        ]); 
    ?>
    <?php else: ?> 
    <?= $this->render('_form', [
        'model' => $model,
        ]);
    ?>
    <?php endif ?>
</div>
