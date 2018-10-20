<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\IncidentRefRegion */

$this->title = 'Create Incident Ref Region';
$this->params['breadcrumbs'][] = ['label' => 'Incident Ref Regions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incident-ref-region-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <pre><?php 
$session = Yii::$app->session;
echo $session['ref_company_id'];
echo '<br>';
?></pre>
    <?= $this->render('_bond', [
        'model' => $model,
        ]); 
    ?>

</div>
