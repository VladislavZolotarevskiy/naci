<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\PersonsRefRegion */

$this->title = 'Привязать к региону';
?>
<div class="persons-ref-region-create">

<?php if (!$person_id == null): ?>
<?=       $this->render('_bond', [
            'model' => $model,
            'person_id' => $person_id,
            ]); 
?>
<?php else: ?> 
<?=      $this->render('_form', [
            'model' => $model,
            ]);  
?>
<?php endif ?>
</div>
