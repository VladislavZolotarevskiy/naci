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

<?php if ($motherlover == null):?>
Motherlover is null
<?php else :?>
<?= $motherlover?>
<?php endif ?>

<div class="incident-form">

    <?php Pjax::begin(); ?>
    <?php $form = ActiveForm::begin([
        'id' => 'incident-create-form',
        'options' => ['data-pjax' => true],
        ]); ?>
  
    
    <?= $form->field($model_incident, 'ref_company_id')->widget(Select2::classname(),[
        'data' => RefCompany::companyList(),
        'options' => ['placeholder' => 'Выберите компанию'],
        'language' => 'ru',
        'pluginEvents' => [
            "select2:selecting" => "function() { var alerts; alerts = $('#select2-incident-ref_company_id-container').serialize(); console.log(alerts); }"],
    ])?>
    
    <?= $form->field($model_incident_ref_region, 'ref_region_id')->widget(Select2::classname(),[
        'data' => RefRegion::regionList(),
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
            "select2:open" => "function() { var alerts; alerts = $('.select2-selection__choice').text(); alert(alerts); }"], 
        
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
    <?php Pjax::end(); ?>

</div>

<?php
    $formatJs = '
    var formatRepo = function (repo) {
        if (repo.loading) {
            return repo.text;
        }
        var markup =
    \'<div class="row">\' + 
        \'<div class="col-sm-5">\' +
            \'<img src="\' + repo.owner.avatar_url + \'" class="img-rounded" style="width:30px" />\' +
            \'<b style="margin-left:5px">\' + repo.full_name + \'</b>\' + 
        \'</div>\' +
        \'<div class="col-sm-3"><i class="fa fa-code-fork"></i> \' + repo.forks_count + \'</div>\' +
        \'<div class="col-sm-3"><i class="fa fa-star"></i> \' + repo.stargazers_count + \'</div>\' +
    \'</div>\';
        if (repo.description) {
          markup += \'<p>\' + repo.description + \'</p>\';
        }
        return \'<div style="overflow:hidden;">\' + markup + \'</div>\';
    };
    var formatRepoSelection = function (repo) {
        return repo.full_name || repo.text;
    }';
     
    // Register the formatting script
    $this->registerJs($formatJs, View::POS_HEAD);
     
    // script to parse the results into the format expected by Select2
    $resultsJs = '
    function (data, params) {
        params.page = params.page || 1;
        return {
            results: data.items,
            pagination: {
                more: (params.page * 30) < data.total_count
            }
        };
    }';
    // render your widget
    echo Select2::widget([
        'name' => 'kv-repo-template',
        'value' => '14719648',
        'initValueText' => 'kartik-v/yii2-widgets',
        'options' => ['placeholder' => 'Search for a repo ...'],
        'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 2,
            'ajax' => [
                'url' => "https://api.github.com/search/repositories",
                'dataType' => 'json',
                'delay' => 250,
                'data' => new JsExpression('function(params) { return {q:params.term, page: params.page}; }'),
                'processResults' => new JsExpression($resultsJs),
                'cache' => true
            ],
            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
            'templateResult' => new JsExpression('formatRepo'),
            'templateSelection' => new JsExpression('formatRepoSelection'),
        ],
    ]);
            ?>