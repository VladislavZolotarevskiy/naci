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
        'id' => 'tticket-form',
        'enableAjaxValidation' => true,
        'validationUrl' => Url::toRoute([
            './t-ticket/perform-ajax-validation',
            'incident_id' => $incident_id]),
        ]); ?>

    <?= $form->field($model, 'ref_type_tt_id')->
            dropDownList(RefTypeTt::typeList()) ?>

    <?= $form->field($model, 't_number')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
