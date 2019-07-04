<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\RefService;
use kartik\select2\Select2;
use kartik\checkbox\CheckboxX;
use frontend\models\FakeCompany;
use yii\helpers\Url;

$this->registerCss(".select2-selection__rendered { margin-top: 0 !important;}");
?>

<div class="person-ref-service-form">

    <?php $form = ActiveForm::begin([
        'id' => 'person-ref-service-form',
        'enableAjaxValidation' => true,
        'validationUrl' => Url::toRoute([
            'perform-ajax-validation']),
    ]); ?>
    <?= $form->field($person_ref_service, 'persons_id')->hiddenInput(['value' => $person_id])->label(false) ?>
    <?= $form->field($fake_company, 'fake_company_id')->widget(Select2::classname(),[
        'data' => FakeCompany::fakeCompanyList($person_id),
        'options' => ['placeholder' => 'Выберите компанию'],
        'language' => 'ru',
        'pluginEvents' => [
            "select2:select" => 
                "function() {"
                . "var url = '/' + window.location.pathname.split('/')[1] + '/' + 'persons-ref-service' + '/' + 'create';"
                . "var serial = $('#fakecompany-fake_company_id').serialize(); "
                . "$.post(url,serial+'&person_id=".$person_id."',function(data){ $('#person-ref-service-form').replaceWith(data);});} ",
        ]    
    ])?>    
    <?= $form->field($person_ref_service, 'ref_service_id')->widget(Select2::classname(),[
        'data' => RefService::serviceList([
            'ref_company_id' => $fake_company->fake_company_id
        ]),
        'language' => 'ru',
        'options' => ['placeholder' => 'Выберите сервис'],
    ]) ?>
    <label class="control-label" for="priority">Приоритет</label>
    <div class="priority" style="margin-bottom: 1em">
        
        
            <?= CheckboxX::widget([
            'name' => 'low',
            'initInputType' => CheckboxX::INPUT_CHECKBOX,
            'model' => $fake_importance,
            'attribute' => 'low',
            'autoLabel' =>true,
            'pluginOptions' => [
                'threeState' => false,
                'size' => 'sm',
                'enclosedLabel' => true,
            ],
            ]);?>  
            
            <?= CheckboxX::widget([
                'name' => 'middle',
                'initInputType' => CheckboxX::INPUT_CHECKBOX,
                'model' => $fake_importance,
                'attribute' => 'middle',
                'autoLabel' =>true,
                'pluginOptions' => [
                    'threeState' => false,
                    'size' => 'sm',
                    'enclosedLabel' => true,
                ],
            ]);?>
        
            <?= CheckboxX::widget([
                'name' => 'high',
                'initInputType' => CheckboxX::INPUT_CHECKBOX,
                'model' => $fake_importance,
                'attribute' => 'high',
                'autoLabel' =>true,
                'pluginOptions' => [
                    'threeState' => false,
                    'size' => 'sm',
                    'enclosedLabel' => true,
                ],
            ]);?>
        
            <?= CheckboxX::widget([
                'name' => 'critical',
                'initInputType' => CheckboxX::INPUT_CHECKBOX,
                'model' => $fake_importance,
                'attribute' => 'critical',
                'autoLabel' =>true,
                'pluginOptions' => [
                    'threeState' => false,
                    'size' => 'sm',
                    'enclosedLabel' => true,
                ],
            ]);?>
    </div>
        <?= Html::submitButton('Привязать', ['class' => 'btn btn-success']) ?>
    
    <?php ActiveForm::end(); ?>

</div>