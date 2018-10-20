<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\RefRegion;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model frontend\models\Contacts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contacts-form">

    
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'ref_region_id')->widget(Select2::classname(),[
        'data' => RefRegion::regionList(['array' => true]),
        'language' => 'ru',
        'options' => ['multiple' => true, 'placeholder' => 'Select  ...'],
        
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
