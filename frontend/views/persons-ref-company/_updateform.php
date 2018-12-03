<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\RefCompany;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\Contacts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="companies-form">
    <?php Pjax::begin(); ?>    
    <?php $form = ActiveForm::begin([
        'id' => 'companies-form',
        'options' => ['data-pjax' => true],
        'enableAjaxValidation' => true,
        'validationUrl' => Url::toRoute([
            './persons-ref-company/perform-ajax-validation',
            'person_id' => $model->persons_id]),
        ]); ?>

    <?= $form->field($model, 'ref_company_id')->dropDownList(RefCompany::companyList()) ?>

    <div class="form-group">

        <?= Html::submitButton('Привязать', ['class' => 'btn btn-success']) ?>

    </div>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
</div>