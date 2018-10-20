<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\RefRegion */

$this->title = 'Добавить регион';
?>
<div class="ref-region-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
