<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use frontend\models\RefCompany;

/* @var $this yii\web\View */
/* @var $model frontend\models\IncidentSearch */
/* @var $form yii\widgets\ActiveForm */
$datetime = new DateTime();
$current_datetime = $datetime->format('Y-m-d H:i:s');
$current_year = $datetime->format('Y');
?>
<div class="col-md-6" style="text-align: right">
<?php if (!($model->ref_company_id == null)||!($model->inc_number == null)||!($model->period == null)||
          !($model->type == null)||!($model->status == null)||!($model->service == null)||
          !($model->service == null)||!($model->city == null)||!($model->region == null)) :?>
    <a class="btn btn-primary disabled" role="button" data-toggle="collapse" href="#incident-search" aria-expanded="false" aria-controls="incident-search">Фильтр</a>
            </div>
        </div>
    </div>
<div class="collapse show" id="incident-search">
<?php else :?>
    <a class="btn btn-primary" role="button" data-toggle="collapse" href="#incident-search" aria-expanded="false" aria-controls="incident-search">Фильтр</a>
            </div>
        </div>
    </div>
<div class="collapse" id="incident-search">
<?php endif ?>    
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
    
    <?= $form->field($model, 'type')->widget(Select2::classname(),[
        'data' => [
            1 => 'Обычный',
            2 => 'Кризисный',
        ],
        'options' => ['placeholder' => 'Выбрать тип'],
        'language' => 'ru',
        ])?>
    
    <?= $form->field($model, 'status')->widget(Select2::classname(),[
        'data' => [
            1 => 'Создан',
            2 => 'Открыт',
            3 => 'Закрыт',
        ],
        'options' => ['placeholder' => 'Выбрать статус'],
        'language' => 'ru',
        ])?>
    
    <?= $form->field($model, 'inc_number') ?>

    <?= $form->field($model, 'ref_company_id')->widget(Select2::classname(),[
        'data' => RefCompany::companyList(),
        'options' => ['placeholder' => 'Выбрать компанию'],
        'language' => 'ru',
        ])?>
    
    <?= $form->field($model, 'service')->widget(Select2::classname(),[
        'data' => frontend\models\RefService::serviceList(),
        'language' => 'ru',
        'options' => ['multiple' => true, 'placeholder' => 'Выбрать сервис'],
        ])?>
    
    <?= $form->field($model, 'region')->widget(Select2::classname(),[
        'data' => frontend\models\RefRegion::regionList(),
        'language' => 'ru',
        'options' => ['multiple' => true, 'placeholder' => 'Выбрать регион'],
        ])?>
   
    <?= $form->field($model, 'city')->widget(Select2::classname(),[
        'data' => frontend\models\RefCity::citiesList(),
        'language' => 'ru',
        'options' => ['multiple' => true, 'placeholder' => 'Выбрать населённый пункт'],
        ])?>
    
    <?= $form->field($model, 'place')->widget(Select2::classname(),[
        'data' => frontend\models\RefPlace::placeList(),
        'language' => 'ru',
        'options' => ['multiple' => true, 'placeholder' => 'Выбрать площадку'],
        ])?>

    <div clas="row">
        <div class="col-md-6" style="padding-left:0">
            <?php /** $form->field($model, 'start_date')->widget(kartik\datetime\DateTimePicker::classname(), [
            'name' => 'start_date',
            'language' => 'ru',
            'removeButton' => false,
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'yyyy-mm-dd hh:ii:ss'],
            'options' => [
                'value' => $current_year.'-01-01 00:00:00',
            ]
            ]);**/?>
        </div>    
        <div class="col-md-6" style="padding-right:0">
            <?php /**$form->field($model, 'end_date')->widget(kartik\datetime\DateTimePicker::classname(), [
            'name' => 'end_date',
            'language' => 'ru',
            'removeButton' => false,
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'yyyy-mm-dd hh:ii:ss'],
            'options' => [
                'value' => $current_datetime,
            ]
            ]);**/ ?>
        </div>    
    </div>   
    <div class="form-group">
        <?= Html::submitButton('Найти', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Сбросить', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
