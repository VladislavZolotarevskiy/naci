<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\RefService;
use kartik\select2\Select2;
use frontend\models\RefRegion;
use frontend\models\PersonsRefServiceRefRegion;

//$RegionList = PersonsRefServiceRefRegion::RegionList($person_ref_service_model->id);
?>

<div class="person-ref-service-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($person_ref_service_model, 'ref_service_id')->dropDownList(RefService::serviceList()) ?>

    <div class="regions">
       
    <?= Html::a('<span class="fa fa-plus"></span> ' .
                '', '#', [
                'onclick' => 
                "$('.regions').append('<p>Test</p>')",
                ]) ?>
    
    
         
    </div>     
    <?= $form->field($person_ref_service_ref_region, 'ref_region_id')->widget(Select2::classname(),[
        'data' => RefRegion::regionList(),
        'language' => 'ru',
        'options' => ['multiple' => true, 'placeholder' => 'Выберите регион'],
    ]) ?>
    
    
    <div class="form-group">
        <?= Html::submitButton('Привязать', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>