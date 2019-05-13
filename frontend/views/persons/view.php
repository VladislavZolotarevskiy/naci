<?php

use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model frontend\models\Persons */

$this->title = $model->personFullName($model->id)['full_name'];
Url::remember(['view', 'id'=> $model->id],'persons-view');
?>

<?=$this->render('_modal')?>


<div class="persons-view">

    <p>
        <?= Html::a('Назад',
            ['index'],
            ['class' => 'btn btn-danger'])?>
        <?= Html::a('Изменить ФИО',
            ['update', 'id' => $model->id],
            ['class' => 'btn btn-primary'])?>
        <?= Html::a('Удалить',
            ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы точно уверены, что хотите удалить данного'
                . ' сотрудника? Все связанные с ним элементы будут '
                . 'также уничтожены.',
                'method' => 'post',
            ],
        ]) ?>
    </p>
</div>
<div class="row">
    <!--Contacts-->
    <div class="col-md-6 col-sm-12 col-xs-12">
        <?= $this->render('_contacts',[
            'contactsDataProvider' => $contactsDataProvider,
            'person_id' => $model->id
        ])?>
    </div>
    <!--Companies-->
    <div class="col-md-6 col-sm-12 col-xs-12">
        <?= $this->render('_companies',[
            'companiesDataProvider' => $companiesDataProvider,
            'person_id' => $model->id
        ])?>
    </div>
</div>
<div>
    <!--Service-ref-importance-->
    <?= $this->render('_services', [
            'serviceDataProvider' => $serviceDataProvider,
            'person_id' => $model->id
    ])?>
</div>