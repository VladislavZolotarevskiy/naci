<?php 

use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use frontend\models\RefCompany;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Открытие инцидента';
$session = Yii::$app->session;
?>    

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model_incident, 'ref_company_id')
        ->dropDownList(RefCompany::companyList(),['disabled' => 'disabled']); ?>

<?= $form->field($model_incident_ref_region, 'ref_region_id_multiply')
        ->widget(Select2::classname(),[
            'language' => 'ru',
            'options' => ['multiple' => true, 'placeholder' => 'Выберите регион'],
            'disabled' => true
        ]);
?>     
<?= $form->field($model_incident_ref_city, 'ref_city_id_multiply')
        ->widget(Select2::classname(),[
            'language' => 'ru',
            'options' => ['multiple' => true, 'placeholder' => 'Выберите регион'],
            'disabled' => true
        ]);
?>     

<?= $form->field($model_incident_ref_place, 'ref_place_id_multiply')
        ->widget(Select2::classname(),[
            'language' => 'ru',
            'options' => ['multiple' => true, 'placeholder' => 'Выберите регион'],
            'disabled' => true
        ]);
?>

<?= $form->field($model_incident_ref_service, 'ref_service_id_multiply')
        ->widget(Select2::classname(),[
            'language' => 'ru',
            'options' => ['multiple' => true, 'placeholder' => 'Выберите регион'],
            'disabled' => true
        ]);
?>
<?php ActiveForm::end(); ?>
<div class="form-group">
    <?= Html::a('Назад', Url::previous(), ['class' => 'btn btn-danger']) ?>
    <?= Html::a('Далее', 'open', ['class' => 'btn btn-success']) ?>
</div>
