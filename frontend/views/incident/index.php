<?php
use frontend\models\Incident;
use yii\helpers\Html;
use yii\grid\GridView;
use frontend\assets\IncidentOpenOnClick;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\IncidentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Инциденты';
$this->registerCss(".grid-view { overflow-x: auto;}");
//$this->registerCss(".clickedRow { border: 0.22em solid #3c8dbc !important; background-color: #f4f4f4 !important;}");
$this->registerCss(".clickedRow { color: #f4f4f4 !important; background-color: #3c8dbc !important;}");
$this->registerCss("h1 { color: #337ab7;}");
IncidentOpenOnClick::register($this);
?>
<div class="incident-index">
    <div class="management">
        <div class="row">
            <div class="col-md-6">
                <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
            </div>
            
    <?= $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'id' => 'incident-table',
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'layout'=>"{items}\n{pager}",
        'tableOptions' => [
            'class' => 'table table-bordered'
        ],
        'columns' => [
            [
                'headerOptions' => ['width' => '140'],
                'attribute' => 'type',
                'label' => 'Тип',
                'value' => function ($model){
                    if ($model->type == 1) {
                        return 'Обычный';
                    }
                    return 'Кризисный';
                },
                'filter' =>  [
                        1 => 'Обычный',
                        2 => 'Критичный'
                ]
            ],
            [
                //'headerOptions' => ['width' => '130'],
                'attribute' => 'status',
                'label' => 'Статус',
                'value' => function ($model){
                    if ($model->status == 1) {
                        return 'Создан';
                    }
                    elseif ($model->status == 2){
                        return 'Открыт';
                    }
                    return 'Закрыт';
                },
                'filter' => [
                        1 => 'Создан',
                        2 => 'Открыт',
                        3 => 'Закрыт'
                    ]
                ],
            [
                //'headerOptions' => ['width' => '80'],
                'attribute' => 'inc_number',
                'label' => '№',
            ],
            [
                'attribute' => 'ref_company_id',
                'value' => 'company.name',
                'filter' => Incident::companyList(),
                'label' => 'Компания',
            ],
            [   'label' => 'Регион',
                'format'=>'raw',
                'value' => function ($model) {
                    foreach ($model->incidentRegions as $item) {
                        $data = '';
                        $data .= $item->name.Html::tag('br');
                    }
                    return $data;
                }
                ],
            ['label' => 'Сервис',
                'format'=>'raw',
                'value' => function ($model) {
                    foreach ($model->incidentServices as $item) {
                        $data = '';
                        $data .= $item->name.Html::tag('br');
                    }
                    return $data;
                }
                ],
            [   'label' => 'Нас. пункт',
                'format'=>'raw',
                'value' => function ($model) {
                    foreach ($model->incidentCities as $item) {
                        $data = '';
                        $data .= $item->name.Html::tag('br');
                    }
                    return $data;
                }
                ],
            [   'label' => 'Площадка',
                'format'=>'raw',
                'value' => function ($model) {
                    foreach ($model->incidentPlaces as $item) {
                        $data = '';
                        $data .= $item->name.Html::tag('br');
                    }
                    return $data;
                }
                ],
            [   'attribute' => 'start',
                'label' => 'Начало',
//                'filter' => Html::input('text','IncidentSearch[start]'),
                'value' => function ($model){
                    $data ='';
                    foreach ($model->incidentSteps as $item) {
                        if ($item->ref_type_steps_id == 1){
                            $data .= $item->clock;
                        }
                    }
                    return $data;
                }
            ],
            [   'attribute' => 'end',
                'label' => 'Завершение',
                //'filter' => Html::input('text','IncidentSearch[end]'),
                'value' => function ($model){
                    $data ='';
                    foreach ($model->incidentSteps as $item) {
                        if ($item->ref_type_steps_id == 3){
                            $data .= $item->clock;
                        }
                    }
                    return $data;
                }
            ],
            [
                'label' => 'Ответственный',
                'value' => function ($model){
                    $data ='';
                    foreach ($model->incidentSteps as $item) {
                        if ($item->ref_type_steps_id == 3) {
                            $data = $item->res_person;
                        }
                        elseif ($item->ref_type_steps_id == 2) {
                            $data = $item->res_person;
                        }
                        else {
                            $data = $item->res_person;
                        }
                    }
                    return $data;
                }
            ],
            [
                'label' => 'Дежурный',
                'value' => function ($model){
                    $data ='';
                    foreach ($model->incidentSteps as $item) {
                        if ($item->ref_type_steps_id == 3) {
                            $data = $item->super_person;
                        }
                        elseif ($item->ref_type_steps_id == 2) {
                            $data = $item->super_person;
                        }
                        else {
                            $data = $item->super_person;
                        }
                    }
                    return $data;
                }
            ],
//            [
//                'format'=>'raw',
//                'label' => 'Провайдер',
//                'value' => function ($model){
//                    $data = '';
//                    if (isset($model->incidentTt)){
//                        foreach ($model->incidentTt as $item){
//                            $data .= $item->t_number.Html::tag('br');
//                        }
//                        return $data;
//                    }
//                }
//            ],
//            [
//                'format'=>'raw',
//                'label' => 'ServiceNow',
//                'value' => function ($model){
//                    $data = '';
//                    if (isset($model->incidentSn)){
//                        foreach ($model->incidentSn as $item){
//                            $data .= $item->t_number.Html::tag('br');
//                        }
//                        return $data;
//                    }
//                }
//            ],
            [        
                'attribute' => 'duration',
                'label' => 'Продолжительность (чч:мм:сс)'
            ],    
            [        
                'attribute' => 'stoppage',
                'label' => 'Время простоя (чч:мм:сс)'
            ],    
//            [
//                'class' => 'yii\grid\ActionColumn',
//                'template' => '{update}',
//                'urlCreator' => function ($action, $model, $key, $index) {
//                    if ($action === 'update') {
//                        $url = ['view', 'id' => $model->id];
//                        return $url;
//                    }
//                }
//            ],
        ],
    ]); ?>
</div>
