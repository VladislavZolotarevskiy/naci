<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\helpers\Url;
?>
<div class="add-snapshot-form">
   <?php Pjax::begin(); ?>
    <?php $form = ActiveForm::begin([
        'id' => 'add-snapshot-form',
        'options' => ['data-pjax' => true],
        'enableAjaxValidation' => true,
        'validationUrl' => Url::toRoute([
            'perform-ajax-validation']),
        ]); ?>

  <?= $form->field($snapshot_model, 'persons_full_name') ?>
  
  <?php if ($snapshot_model->type == 2):?>
     
  <?= $form->field($snapshot_model, 'contact')->input('email')->label('e-mail') ?>
  
  <?php elseif ($snapshot_model->type == 1):?>  
    
  <?= $form->field($snapshot_model, 'contact')->widget(\yii\widgets\MaskedInput::className(), [
    'mask' => '79999999999',
      'clientOptions'=>[
            'clearIncomplete'=>true
        ]
])->label('Телефон') ?>
    
  <?php endif ?>
    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
</div>