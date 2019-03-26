<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model frontend\models\TTicket */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tticket-form">
    <?php $form = ActiveForm::begin([
        'id' => 'user_change_password',
        ]); ?>
    
    <?= $form->field($model, 'password')->passwordInput() ?>
    

    <div class="form-group">
        <?= Html::submitButton('Применить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
