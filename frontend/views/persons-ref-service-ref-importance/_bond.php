<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\RefImportance;

/* @var $this yii\web\View */
/* @var $model frontend\models\Contacts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contacts-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'persons_ref_service_id')->hiddenInput(['value' => $person_ref_service_id])->label(false) ?>

    <?= $form->field($model, 'ref_importance_id')->dropDownList(RefImportance::importanceList()) ?>

    <div class="form-group">
        <?= Html::a('Назад', [
            'persons-ref-service-ref-importance/index',
            'person_ref_service_id' => $person_ref_service_id], [
                'class' => 'btn btn-danger']) ?>
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
