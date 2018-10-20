<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\IncidentRefService */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="incident-ref-service-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'incident_id')->textInput() ?>

    <?= $form->field($model, 'ref_service_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
