<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model frontend\models\TTicket */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-create-form">
  
    
    <?php $form = ActiveForm::begin([
        'id' => 'create-user',
        'options' => ['data-pjax' => true],
        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
        'validationUrl' => Url::toRoute([
            'perform-ajax-validation']),
        ]);
    ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true,'autofocus' => true]) ?>
    
    <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'email')->input('email') ?>
    
    <?= $form->field($model, 'password')->passwordInput() ?>
    
    <?= $form->field($model, 'admin')->checkbox() ?>
    

    <div class="form-group">
        <?= Html::submitButton('Создать', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
