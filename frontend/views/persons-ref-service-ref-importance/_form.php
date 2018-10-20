<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PersonsRefServiceRefImportance */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="persons-ref-service-ref-importance-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'persons_ref_service_id')->textInput() ?>

    <?= $form->field($model, 'ref_importance_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
