<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\IncidentRefPlace */

$this->title = 'Create Incident Ref Place';
$this->params['breadcrumbs'][] = ['label' => 'Incident Ref Places', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incident-ref-place-create">

 <h1><?= Html::encode($this->title) ?></h1>
    <pre><?php 
$session = Yii::$app->session;
echo $session['ref_company_id'];
echo '<br> Region';
print_r($session['ref_region_id']);
echo '<br> City';
print_r($session['ref_city_id']);
echo '<br>';
?></pre>
    <?= $this->render('_bond', [
        'model' => $model,
        ]); 
    ?>
</div>
