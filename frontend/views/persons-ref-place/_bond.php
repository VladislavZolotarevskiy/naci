<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\RefPlace;

/* @var $this yii\web\View */
/* @var $model frontend\models\Contacts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contacts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'persons_id')->hiddenInput(['value' => $person_id])->label(false) ?>

    <?= $form->field($model, 'ref_place_id')->dropDownList(RefPlace::placeList()) ?>

    <div class="form-group">
        <?= Html::a('Назад', ['persons/view','id' => $person_id], [
                'class' => 'btn btn-danger']) ?>
        <?= Html::submitButton('Привязать', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
