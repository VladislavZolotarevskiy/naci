<?php
use yii\widgets\ActiveForm;
use frontend\models\RefTypeTt;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model frontend\models\TTicket */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tticket-form">
    <?php $form = ActiveForm::begin([
        'id' => 'user_create',
        ]); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Создать', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
