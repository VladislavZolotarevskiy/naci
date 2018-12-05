<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\RefCityType;
use frontend\models\RefRegion;

/* @var $this yii\web\View */
/* @var $model frontend\models\RefCity */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-city-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ref_city_type_id')
            ->dropDownList(RefCityType::typesList()) ?>

    <?= $form->field($model, 'ref_region_id')
            ->dropDownList(RefRegion::regionList()) ?>

    <div class="form-group">
        <?= Html::a('Назад', '../ref-city', [
                'class' => 'btn btn-danger']) ?>
        <?= Html::submitButton('Применить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
