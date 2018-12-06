<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\RefCompany;
use frontend\models\RefCity;
use frontend\models\RefRegion;
use frontend\models\RefPlace;
use frontend\models\RefService;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model frontend\models\Incident */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="incident-form">

    <?php $form = ActiveForm::begin([
        'id' => 'incident-create-form',
        ]); ?>
  
    <?= $form->field($model_incident, 'ref_company_id')->widget(Select2::classname(),[
        'data' => RefCompany::companyList(),
        'options' => ['placeholder' => 'Выберите компанию'],
        'language' => 'ru',
        'pluginEvents' => [
            "select2:select" => "function() { var alerts; alerts = $('#incident-create-form').serialize(); $.post('create',alerts,function(data){ $('#incident-create-form').replaceWith(data);});} "],
    ])?>
    
    <?= $form->field($model_incident_ref_region, 'ref_region_id')->widget(Select2::classname(),[
        'data' => RefRegion::regionList([
        ]),
        'language' => 'ru',
        'options' => ['multiple' => true, 'placeholder' => 'Выберите регион'],
        'pluginEvents' => [
            "select2:select" => "function() { var alerts; alerts = $('#incident-create-form').serialize(); $.post('create',alerts,function(data){ $('#incident-create-form').replaceWith(data);});} "],
    ]) ?>
    
    <?= $form->field($model_incident_ref_city, 'ref_city_id')->widget(Select2::classname(),[
        'data' => RefCity::citiesList([
            'ref_region_id' => $model_incident_ref_region->ref_region_id]),
        'language' => 'ru',
        'options' => ['multiple' => true, 'placeholder' => 'Выберите город'],
        'pluginEvents' => [
            "select2:select" => "function() { var alerts; alerts = $('#incident-create-form').serialize(); $.post('create',alerts,function(data){ $('#incident-create-form').replaceWith(data);});} "], 
        
    ]) ?>
     
     <?= $form->field($model_incident_ref_place, 'ref_place_id')->widget(Select2::classname(),[
        'data' => RefPlace::placeList([
            'ref_city_id' => $model_incident_ref_city->ref_city_id,]),
        'language' => 'ru',
        'options' => ['multiple' => true, 'placeholder' => 'Выберите площадку'],
        
    ]) ?>
     <?= $form->field($model_incident_ref_service, 'ref_service_id')->widget(Select2::classname(),[
        'data' => RefService::serviceList(),
        'language' => 'Ru',
        'options' => ['multiple' => true, 'placeholder' => 'Выберите сервис'],
        
    ]) ?>
        
    <div class="form-group">
        <?= Html::a('Назад', './', [
                'class' => 'btn btn-danger']) ?>
        <?= Html::submitButton('Далее', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>