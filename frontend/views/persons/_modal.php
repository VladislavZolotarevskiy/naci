<?php
use yii\helpers\Html;
use yii\bootstrap\Modal?>

<?= Modal::widget([
    'id' => 'modal-contact-create',
    'header' => Html::tag('h4', Html::encode('Добавить контакт'),['class' => 'username']),
]);?>
<?= Modal::widget([
    'id' => 'modal-contact-update',
    'header' => Html::tag('h4', Html::encode('Редактировать контакт'),['class' => 'username']),
]);?>
<?= Modal::widget([
    'id' => 'modal-company-create',
    'header' => Html::tag('h4', Html::encode('Привязать к компании'),['class' => 'username']),
]);?>
<?= Modal::widget([
    'id' => 'modal-company-update',
    'header' => Html::tag('h4', Html::encode('Редактировать'),['class' => 'username']),
]);?>