<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\RefCompany */

$this->title = 'Добавить компанию';
?>
<div class="ref-company-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
