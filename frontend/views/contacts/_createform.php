<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\RefContactType;
use kartik\select2\Select2;
use yii\helpers\Url;
$this->registerCss(".select2-selection__rendered { margin-top: 0 !important;}");
/* @var $this yii\web\View */
/* @var $model frontend\models\Contacts */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="contacts-form">
<?php $form = ActiveForm::begin([
        'enableAjaxValidation' => true,
        'validationUrl' => Url::toRoute([
            './contacts/perform-ajax-validation']),
        'id' => 'contacts-form'
        ]); ?>
    
    <?= $form->field($model, 'ref_contact_type_id')->widget(Select2::classname(),[
        'data' => RefContactType::contactTypesList(),
        'options' => ['placeholder' => 'Выбрать'],
        'language' => 'ru',
        'pluginEvents' => [
            "select2:select" => "function() { var type; type = $('#contacts-form').serialize(); $.get('/naci/contacts/create',type,function(data){ $('#contacts-form').replaceWith(data);});} ",
            //"select2:select" => "function() { var type; type = $('#contacts-form').serialize(); alert(type);}"
            
        ]    
    ])?> 
    
    <?php if ($model->ref_contact_type_id == 1):?>
    
    <?= $form->field($model, 'name')->widget(\yii\widgets\MaskedInput::className(), [
        'options' => ['placeholder' => '7XXXXXXXXXX'],
		'mask' => '99999999999',
        'clientOptions'=>[
        'clearIncomplete'=>true
            ]])
            ->label('Телефон') ?>
    
    <?php elseif ($model->ref_contact_type_id == 2): ?>
    
    <?= $form->field($model, 'name')->input('email')->label('e-mail') ?>
    
    <?php elseif ($model->ref_contact_type_id == 3): ?>
    
    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Рабочий телефон') ?>
    
    <?php endif ?>
    
    <?= $form->field($model, 'id_person')->hiddenInput(['value' => $person_id])->label(false) ?>
    
    <div class="form-group">
        <?= Html::submitButton('Создать', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>