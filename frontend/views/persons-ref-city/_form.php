<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PersonsRefCity */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="persons-ref-city-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'persons_id')->textInput() ?>

    <?= $form->field($model, 'ref_city_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
