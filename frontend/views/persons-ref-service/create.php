<?php

/* @var $this yii\web\View */
/* @var $model frontend\models\PersonsRefRegion */

$this->title = 'Привязать к сервису';
?>
<div class="persons-ref-region-create">
<?=      
    $this->renderAjax('_form', [
        'model' => $model,
        'person_id' => $person_id
    ]);  
?>
</div>
