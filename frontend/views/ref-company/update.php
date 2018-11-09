<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\RefCompany */

$this->title = 'Редактировать компанию: ' . $model->name;
?>
<div class="ref-company-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
