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
<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">
        <!--Regions-->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Регионы</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th scope="col", class="col-md-0"></th>
                            <th scope="col", class="col-md-12">Регион</th>
                        </tr>
                    </thead>
                    <tbody>
                                <?php foreach ($model->regionsList($model->id) as $one):?>
                            <tr>
                                <td scope="row"><?=Html::a('', [
                                        '/persons-ref-region/delete',
                                        'id' => $one['id'],
                                        'person_id' => $model->id],[
                                        'class' => "fa fa-minus text-red",
                                        'title' => "Отвязать от региона",
                                        'data-confirm' => "Отвязать от "
                                            . "региона?",
                                        'data-method' => "post"])?></td>
                                <td scope="row"><?= $one['refRegion']['name']?></td>
                            </tr>
                                <?php endforeach ?>
                        <tr>
                            <td scope="row"><?= Html::a('', [
                                '/persons-ref-region/create',
                                'person_id' => $model->id], [
                                'title' => 'Привязать к региону',     
                                'class' => 'fa fa-plus text-blue'])?></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12">
        <!--Cities-->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Населённые пункты</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th scope="col", class="col-md-0"></th>
                            <th scope="col", class="col-md-12">Населённый
                                пункт</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($model->citiesList($model->id) as
                                $one): ?>
                            <tr>
                                <td scope="row"><?= Html::a('',[
                                    '/persons-ref-city/delete',
                                    'id' => $one['id'],
                                    'person_id' => $model->id], [
                                    'class' => "fa fa-minus text-red",
                                    'title' => "Отвязать от населённого "
                                        . "пункта.",
                                    'data-confirm' =>"Отвязать от населённого "
                                        . "пункта?",
                                    'data-method' => "post"])?></td>
                                <td scope="row"><?= $one['city'] ?></td>
                            </tr>
                            <?php endforeach ?>
                        <tr>
                            <td scope="row"><?= Html::a('',[
                                '/persons-ref-city/create',
                                'person_id' => $model->id],
                                ['class' => 'fa fa-plus text-blue'])?></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">
        <!--Places-->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Площадки</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th scope="col", class="col-md-0"></th>
                            <th scope="col", class="col-md-12">Площадка</th>
                        </tr>
                    </thead>
                    <tbody>
                                <?php foreach ($model->placesList($model->id) as $one):?>
                            <tr>
                                <td scope="row"><?=Html::a('', [
                                        '/persons-ref-place/delete',
                                        'id' => $one['id'],
                                        'person_id' => $model->id],[
                                        'class' => "fa fa-minus text-red",
                                        'title' => "Отвязать от площадки",
                                        'data-confirm' => "Отвязать от "
                                            . "площадки?",
                                        'data-method' => "post"])?></td>
                                <td scope="row"><?= $one['refPlace']['name']?></td>
                            </tr>
                                <?php endforeach ?>
                        <tr>
                            <td scope="row"><?= Html::a('', [
                                '/persons-ref-place/create',
                                'person_id' => $model->id], [
                                'class' => 'fa fa-plus text-blue'])?></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12">
        <!--Cities-->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Сервисы</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th scope="col", class="col-md-0"></th>
                            <th scope="col", class="col-md-6">Сервис</th>
                            <th scope="col", class="col-md-6">Приоритет</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($model->serviceList($model->id) as
                                $one): ?>
                            <tr>
                                <td scope="row"><?= Html::a('',[
                                    '/persons-ref-service/delete',
                                    'id' => $one['id'],
                                    'person_id' => $model->id], [
                                    'class' => "fa fa-minus text-red",
                                    'title' => "Отвязать от сервиса",
                                    'data-confirm' =>"Отвязать от сервиса?",
                                    'data-method' => "post"])?></td>
                                <td scope="row"><?= $one['refService']['name']?>
                                </td>
                                <td scope="row"><?php foreach (
                                        $model->importanceList(
                                        ['person_ref_service_id' => $one['id']])
                                        as $two ):?>
                                <?= $two['refImportance']['name']?>
                                <?php endforeach ?><?= Html::a('',[
                                '/persons-ref-service-ref-importance/importance',
                                'person_ref_service_id' =>
                                    $one['id']],
                                ['class' => 'fa fa-pencil text-blue'])?>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        <tr>
                            <td scope="row"><?= Html::a('',[
                                '/persons-ref-service/create',
                                'person_id' => $model->id],
                                ['class' => 'fa fa-plus text-blue'])?></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
</div>
