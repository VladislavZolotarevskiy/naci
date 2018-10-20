<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\RefContactType;

/* @var $this yii\web\View */
/* @var $model frontend\models\Contacts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contacts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_person')->hiddenInput(['value' => $person_id])->label(false) ?>
    
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ref_contact_type_id')->dropDownList(RefContactType::contactTypesList()) ?>

    <div class="form-group">
        <?= Html::a('Назад', ['persons/view', 'id' => $person_id], [
                'class' => 'btn btn-danger'])?>
        <?= Html::submitButton('Создать', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>