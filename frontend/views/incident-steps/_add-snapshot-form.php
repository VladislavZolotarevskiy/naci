<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\helpers\Url;
?>

<?php if (array_search('Култышев', $snapshot_model->incident_steps_snapshot['mail'])):?>
<?= 'Есть' ?>
<?php else :?>
<?= 'Нет' ?>
<?php endif ?>
<pre>
<?php $res = 0 ?>
    <?php foreach($snapshot_model->incident_steps_snapshot['mail'] as $item):?>
    <?php foreach ($item as $subitem ): ?>
    <?php if (strpos($subitem, 'SemenyukAP') !== false) :?>
    <?php $res += 1?>
    <?php endif?>
    <?php endforeach;?>
<?php endforeach;?>
</pre>
<?= $res ?>

<div class="add-snapshot-form">
   <?php Pjax::begin(); ?>
    <?php $form = ActiveForm::begin([
        'id' => 'add-snapshot-form',
        'options' => ['data-pjax' => true],
        'enableAjaxValidation' => true,
        'validationUrl' => Url::toRoute([
            'perform-ajax-validation']),
        ]); ?>

  <?= $form->field($snapshot_model, 'persons_full_name') ?>
  <?= $form->field($snapshot_model, 'contact') ?>

    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
</div>