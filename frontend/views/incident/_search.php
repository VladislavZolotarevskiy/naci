<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use frontend\models\RefCompany;

/* @var $this yii\web\View */
/* @var $model frontend\models\IncidentSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<pre>
    <?php if (!($model->ref_company_id == null)): ?>
    <?= 'pidor'?>
    <?php endif ?>
</pre>
<?php if (!($model->ref_company_id == null)||!($model->ref_company_id == null)):?>
<div class="collapse show" id="incident-search">
<?php else :?>
<div class="collapse" id="incident-search">
<?php endif ?>    
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'ref_company_id')->widget(Select2::classname(),[
        'data' => RefCompany::companyList(),
        'options' => ['placeholder' => 'Выберите компанию'],
        'language' => 'ru',
        ])?>
    
    <?= $form->field($model, 'inc_number') ?>

    <?= $form->field($model, 'period') ?>

    <div class="form-group">
        <?= Html::submitButton('Найти', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Сбросить', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
