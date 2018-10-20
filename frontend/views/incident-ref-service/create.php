<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\IncidentRefService */

$this->title = 'Create Incident Ref Service';
$this->params['breadcrumbs'][] = ['label' => 'Incident Ref Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incident-ref-service-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <pre><?php 
    $session = Yii::$app->session;
    echo 'Company:'.$session['ref_company_id'];
    echo '<br> Marker';
    echo ':'.$session['marker'];
    echo '<br> Region';
    print_r($session['ref_region_id']);
    echo '<br> City';   
    print_r($session['ref_city_id']);
    echo '<br> Service';   
    print_r($session['ref_service_id']);
    echo '<br>';
    ?></pre>
    <?= $this->render('_bond', [
        'model' => $model,
        ]); 
    ?>
</div>
