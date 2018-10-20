<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\RefImportance */

$this->title = 'Create Ref Importance';
$this->params['breadcrumbs'][] = ['label' => 'Ref Importances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-importance-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
