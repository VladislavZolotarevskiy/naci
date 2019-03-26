<?php
use yii\widgets\ActiveForm;
use frontend\models\RefTypeTt;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model frontend\models\TTicket */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tticket-form">
    <?php Pjax::begin(); ?>
    <?php $form = ActiveForm::begin([
        'id' => 'tticket-form',
        'options' => ['data-pjax' => true],
        'enableAjaxValidation' => true,
        'validationUrl' => Url::toRoute([
            './t-ticket/perform-ajax-validation',
            'incident_id' => $model->incident_id]),
        ]); ?>

    <?= $form->field($model, 'ref_type_tt_id')->
            dropDownList(RefTypeTt::typeList()) ?>

    <?= $form->field($model, 't_number')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Применить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
</div>
