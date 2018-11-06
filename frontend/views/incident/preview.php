<?php 
use frontend\models\Incident;
use frontend\models\RefCompany;
use frontend\models\RefCity;
use frontend\models\RefRegion;
use frontend\models\RefService;
use frontend\models\RefPlace;
use yii\helpers\Html;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;


$this->title = 'Открытие инцидента';
    $session = Yii::$app->session;
    echo 'Затронутые компании: '.RefCompany::findOne($session['ref_company_id'])['name'];
    echo '<br> Затронутые населенные пункты: ';
    foreach($session['ref_city_id'] as $city_id){
        foreach (RefCity::citiesList(['id' => $city_id]) as $one){
        echo $one.' ';}
    }
    echo '<br> Затронутые регионы: ';   
    foreach($session['ref_region_id'] as $region_id){
        echo RefRegion::findOne($region_id)['name'].' ';
    }
    echo '<br> Затронутые площадки: ';   
    foreach($session['ref_place_id'] as $place_id){
        echo RefPlace::findOne($place_id)['name'].' ';}
    echo '<br> Затронутые сервисы: ';   
    foreach($session['ref_service_id'] as $service_id){
        echo RefService::findOne($service_id)['name'].' ';}
        ?>

<?php $form = ActiveForm::begin(); ?>
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
<?= $form->field($model_incident_ref_region, 'ref_region_id')->widget(Select2::classname(),[
        'data' => RefRegion::regionList(),
        'language' => 'ru',
        'options' => ['multiple' => true, 'placeholder' => 'Выберите регион'],
        'disabled' => true
        
    ]) ?>
 <?= $form->field($model_incident_ref_city, 'ref_city_id')->widget(Select2::classname(),[
        'data' => RefCity::citiesList(),
        'language' => 'ru',
        'options' => ['multiple' => true, 'placeholder' => 'Выберите город'],
         'disabled' => true,
        'pluginOptions' => [
            'tags' => true,
            'tokenSeparators' => [',', ' '],
        ],
    ]) ?>		
 
        
 
<?php ActiveForm::end(); ?>
RefCity::citiesList()
 <pre>
 <?php print_r($model_incident_ref_city['ref_city_id']) ?>
 </pre>