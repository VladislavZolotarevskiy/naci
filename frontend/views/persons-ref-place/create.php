<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\PersonsRefCity */

$this->title = 'Привязать к площадке';
?>
<div class="persons-ref-place-create">

    <?php if (!$person_id == null): ?>
    <?= $this->render('_bond', [
        'model' => $model,
        'person_id' => $person_id,
        ]); 
    ?>
    <?php else: ?> 
    <?= $this->render('_form', [
        'model' => $model,
        ]);
    ?>
    <?php endif ?>
</div>
`