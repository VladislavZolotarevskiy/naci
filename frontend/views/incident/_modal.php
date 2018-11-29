<?php
use yii\helpers\Html;
use yii\bootstrap\Modal?>

<?= Modal::widget([
    'id' => 'contacts',
    'header' => Html::tag('h4', Html::encode('Контакты рассылки'),['class' => 'username']),
]);?>
<?php if ($status !== 3):?>
<?= Modal::widget([
    'id' => 'modal-ticket-create',
    'header' => Html::tag('h4', Html::encode('Добавить заявку'),['class' => 'username']),
]);?>
<?= Modal::widget([
    'id' => 'modal-ticket-update',
    'header' => Html::tag('h4', Html::encode('Редактировать заявку'),['class' => 'username']),
]);?>
<?php endif ?>