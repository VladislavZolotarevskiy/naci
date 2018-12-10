<?php
use yii\helpers\Html;
use yii\bootstrap\Modal?>

<?= Modal::widget([
    'id' => 'modal-snapshot-phone-create',
    'header' => Html::tag('h4', Html::encode('Добавить телефон'),['class' => 'username']),
]);?>
<?= Modal::widget([
    'id' => 'modal-snapshot-mail-create',
    'header' => Html::tag('h4', Html::encode('Добавить e-mail'),['class' => 'username']),
]);?>