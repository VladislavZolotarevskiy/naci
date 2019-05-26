<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\RefService;
use kartik\select2\Select2;
use frontend\models\RefRegion;
use frontend\models\FakeCompany;

$this->registerCss(".select2-selection__rendered { margin-top: 0 !important;}");
?>

<div class="person-ref-service-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($fake_company_model, 'fake_company_id')->widget(Select2::classname(),[
        'data' => FakeCompany::fakeCompanyList($person_id),
        'options' => ['placeholder' => 'Выберите компанию'],
        'language' => 'ru',
        'pluginEvents' => [
            "select2:select" => "function() { var alerts; alerts = $('#person-ref-service-form').serialize(); $.post('../../persons-ref-service/create',alerts,function(data){ $('#incident-create-form').replaceWith(data);});} ",
        ]    
    ])?>
    
    <?= $form->field($person_ref_service_model, 'ref_service_id')->widget(Select2::classname(),[
        'data' => RefService::serviceList([
            'ref_company_id' => $fake_company_model->fake_company_id
        ]),
        'language' => 'ru',
        'options' => ['multiple' => true, 'placeholder' => 'Выберите регион'],
        'pluginEvents' => [
            "select2:select" => "function() { var alerts; alerts = $('#incident-create-form').serialize(); $.post('create',alerts,function(data){ $('#incident-create-form').replaceWith(data);});} ",
            "select2:unselect" => "function() { var alerts; alerts = $('#incident-create-form').serialize(); $.post('create',alerts,function(data){ $('#incident-create-form').replaceWith(data);});} ",
        ],
    ]) ?>
    
    <div class="regions-form">
        
    <?= Html::a('<span class="fa fa-plus"></span> ' .
                '', '#', [
                'onclick' => 
                    "",

                ]) ?>
    
    </div>
    
    <div class="form-group">
        <?= Html::submitButton('Привязать', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>