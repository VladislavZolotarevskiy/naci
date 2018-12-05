<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\RefCompany;
use frontend\models\RefCity;
use frontend\models\RefRegion;
use frontend\models\RefPlace;
use frontend\models\RefService;
use kartik\select2\Select2;
use yii\web\View;
use yii\web\JsExpression;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model frontend\models\Incident */
/* @var $form yii\widgets\ActiveForm */
?>

<?= $model_incident->ref_company_id ?>

<div class="incident-form">

    <?php $form = ActiveForm::begin([
        'id' => 'incident-create-form',
        ]); ?>
  
    
    <?= $form->field($model_incident, 'ref_company_id')->widget(Select2::classname(),[
        'data' => RefCompany::companyList(),
        'options' => ['placeholder' => 'Выберите компанию'],
        'language' => 'ru',
        'pluginEvents' => [
            "select2:select" => "function() { var alerts; alerts = $('#incident-create-form').serialize(); $.post('create',alerts,function(data){ $('#incident-create-form').html(data); alert('hunta')});} "],
    ])?>
    
    <?= $form->field($model_incident_ref_region, 'ref_region_id')->widget(Select2::classname(),[
        'data' => RefRegion::regionList($model_incident->ref_company_id),
        'language' => 'ru',
        'options' => ['multiple' => true, 'placeholder' => 'Выберите регион'],
        
    ]) ?>
    
    <?= $form->field($model_incident_ref_city, 'ref_city_id')->widget(Select2::classname(),[
        'data' => RefCity::citiesList(),
        'language' => 'ru',
        'options' => ['multiple' => true, 'placeholder' => 'Выберите город'],
//        'pluginOptions' => [
//            'ajax' => true
//        ],
        'pluginEvents' => [
            "select2:selecting" => "function() { var alerts; alerts = $('.select2-selection__choice').text(); window.open('create','_self'); }"], 
        
    ]) ?>
     
     <?= $form->field($model_incident_ref_place, 'ref_place_id')->widget(Select2::classname(),[
        'data' => RefPlace::placeList(),
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