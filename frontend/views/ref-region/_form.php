<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\RefCompany;

/* @var $this yii\web\View */
/* @var $model frontend\models\RefRegion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-region-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ref_company_id')
            ->dropDownList(RefCompany::companyList()) ?>
    
    <div class="form-group">
        <?= Html::a('Назад', 'index', [
                'class' => 'btn btn-danger']) ?>
        <?= Html::submitButton($button, ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
