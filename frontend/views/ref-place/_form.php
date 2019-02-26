<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\RefCity;

/* @var $this yii\web\View */
/* @var $model frontend\models\RefPlace */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-place-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ref_city_id')
            ->dropDownList(RefCity::citiesList()) ?>
    
    <div class="form-group">
         <?= Html::a('Назад', 'index', [
                'class' => 'btn btn-danger']) ?>
        <?= Html::submitButton($button, ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
