<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\IncidentRefRegion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="incident-ref-region-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ref_region_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>