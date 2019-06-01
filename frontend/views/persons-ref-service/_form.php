<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\RefService;
use kartik\select2\Select2;
use kartik\checkbox\CheckboxX;
use frontend\models\RefRegion;
use frontend\models\FakeCompany;

$this->registerCss(".select2-selection__rendered { margin-top: 0 !important;}");
?>

<div class="person-ref-service-form">

    <?php $form = ActiveForm::begin([
        'id' => 'person-ref-service-form',
    ]); ?>
    <?= $form->field($fake_company_model, 'fake_company_id')->widget(Select2::classname(),[
        'data' => FakeCompany::fakeCompanyList($person_id),
        'options' => ['placeholder' => 'Выберите компанию'],
        'language' => 'ru',
        'pluginEvents' => [
            "select2:select" => 
                "function() {"
                . "var url = '/' + window.location.pathname.split('/')[1] + '/' + 'persons-ref-service' + '/' + 'create';"
                . "var serial = $('#fakecompany-fake_company_id').serialize(); "
                . "$.post(url,serial,function(data){ $('#person-ref-service-form').replaceWith(data);});} ",
        ]    
    ])?>    
    <?= $form->field($person_ref_service_model, 'ref_service_id')->widget(Select2::classname(),[
        'data' => RefService::serviceList([
            'ref_company_id' => $fake_company_model->fake_company_id
        ]),
        'language' => 'ru',
        'options' => ['placeholder' => 'Выберите сервис'],
        'pluginEvents' => [
            "select2:select" => "function() { var alerts; alerts = $('#incident-create-form').serialize(); $.post('create',alerts,function(data){ $('#incident-create-form').replaceWith(data);});} ",
            "select2:unselect" => "function() { var alerts; alerts = $('#incident-create-form').serialize(); $.post('create',alerts,function(data){ $('#incident-create-form').replaceWith(data);});} ",
        ],
    ]) ?>
    <label class="control-label" for="priority">Приоритет</label>
    <div class="priority">
        
        
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
        <?= Html::button('+ Регион',[
            'class' => 'btn btn-default btn-block',
            'style' => [
                'margin-bottom' => '1em',
                'margin-top' => '1em'],
            'onclick' => "(function() { "
            . "var url = '/' + window.location.pathname.split('/')[1] + '/' + 'persons-ref-service' + '/' + 'create'; "
            . "var count = 1+".$person_ref_service_ref_region->count.";"
            . "var fakecompany_serial = $('#fakecompany-fake_company_id').serialize(); "
            . "var service_serial = $('#personsrefservice-ref_service_id').serialize(); "
            . "$.post(url,fakecompany_serial+'&'+service_serial+'&count='+count,function(data){ $('#person-ref-service-form').replaceWith(data);}); "
            . "})()"
        ]) ?>
        <?php if ($person_ref_service_ref_region->count > 0):?>
        <?= 
            $form->field($person_ref_service_ref_region, '[0]ref_region_id')->widget(Select2::classname(),[
                'data' => RefRegion::regionList([
                    'ref_company_id' => 
                        $fake_company_model->fake_company_id
                ]),
                'language' => 'ru',
                'options' => ['placeholder' => 'Выберите регион'],
                'pluginEvents' => [
                    "select2:select" => "function() { var alerts; alerts = $('#incident-create-form').serialize(); $.post('create',alerts,function(data){ $('#incident-create-form').replaceWith(data);});} ",
                    "select2:unselect" => "function() { var alerts; alerts = $('#incident-create-form').serialize(); $.post('create',alerts,function(data){ $('#incident-create-form').replaceWith(data);});} ",
                ],
        ]) ?>
        <?php endif ?>
        <?= Html::button('+ Город',[
            'class' => 'btn btn-default btn-block',
            'style' => [
                'margin-bottom' => '1em',
                'margin-top' => '1em']
        ]) ?>
        <?= Html::button('+ Площадка',[
            'class' => 'btn btn-default btn-block',
            'style' => [
                'margin-bottom' => '1em',
                'margin-top' => '1em']
        ]) ?>
    <div class="form-group">
        <?= Html::submitButton('Привязать', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>