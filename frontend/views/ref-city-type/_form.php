<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\RefCityType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-city-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::a('Назад', 'index', [
                'class' => 'btn btn-danger']) ?>
        <?= Html::submitButton($button, ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
