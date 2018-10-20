<?php 
use yii\widgets\Pjax;
use yii\helpers\Html;?>

<?php Pjax::begin([
    'timeout' => 999999
]); ?>
<?= Html::a("Refresh", ['../test'], ['class' => 'btn btn-lg btn-primary']) ?>
<h1>Current time: <?= $time ?></h1>
<?php Pjax::end(); ?>