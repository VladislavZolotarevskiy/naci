<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use frontend\models\RefCompany;

/* @var $this yii\web\View */
/* @var $model frontend\models\IncidentSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="col-md-6" style="text-align: right">
<?php if (!($model->ref_company_id == null)||!($model->inc_number == null)||!($model->period == null)) :?>
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

    <?= $form->field($model, 'ref_company_id')->widget(Select2::classname(),[
        'data' => RefCompany::companyList(),
        'options' => ['placeholder' => 'Выберите компанию'],
        'language' => 'ru',
        ])?>
    
    <?= $form->field($model, 'inc_number') ?>

    <?= $form->field($model, 'period') ?>

    <div class="form-group">
        <?= Html::submitButton('Найти', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Сбросить', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
