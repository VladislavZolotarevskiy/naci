<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Сброс пароля';

?>
<div class="login-box">
    <div class="login-logo">
        NACI <b>Monitoring</b>
    </div>
    
    <div class="login-box-body">
        <p class="login-box-msg">Введите ваш адрес электронной почты. Ссылка для сброса пароля будет отправлена на этот адрес.</p>

   
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Восстановить', ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
       
    
    </div>    
</div>
