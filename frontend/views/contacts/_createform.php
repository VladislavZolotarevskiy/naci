<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\RefContactType;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\Contacts */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="contacts-form">
<?php Pjax::begin(); ?>    
<?php $form = ActiveForm::begin([
        'id' => 'contacts-form',
        'options' => ['data-pjax' => true],
        'enableAjaxValidation' => true,
        'validationUrl' => Url::toRoute([
            './contacts/perform-ajax-validation',
            'person_id' => $person_id]),
        ]); ?>
   
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ref_contact_type_id')->dropDownList(RefContactType::contactTypesList()) ?>

    <div class="form-group">
        <?= Html::submitButton('Создать', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
</div>