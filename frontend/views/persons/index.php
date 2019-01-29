<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\assets\PersonsOpenOnClick;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PersonsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сотрудники';
$this->registerCss(
        '.scroll-block {height: 100%;width: 100%; overflow-y: auto; overflow-x: auto;}
        .scroll-block::-webkit-scrollbar-track {border-radius: 4px;}
        .scroll-block::-webkit-scrollbar {width: 6px;}
        .scroll-block::-webkit-scrollbar-thumb {border-radius: 4px;background: #f0f2f5;}
        .scroll-block:hover::-webkit-scrollbar-thumb {background: #6a7d9b;}');
$this->registerCss(".grid-view { overflow-x: auto;}");
$this->registerCss(".clickedRow { color: #f4f4f4 !important; background-color: #3c8dbc !important;}");
$this->registerCss("h1 { color: #337ab7;}");
$this->registerCss(".select2-selection__rendered { margin-top: 0 !important;}");
$this->registerCss(".select2-search--inline { width: 100% !important;}");
$this->registerCss(".select2-search__field { width: 100% !important;}");
PersonsOpenOnClick::register($this);

?>
<div class="persons-index">
    <div class="management">
        <div class="row">
            <div class="col-md-6">
                <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
            </div>    
            <?= $this->render('_search', ['model' => $searchModel]); ?>
    <div class="scroll-block">
    <?= GridView::widget([
        'id' => 'persons-table',
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'layout'=>"{items}\n{pager}",
        'tableOptions' => [
            'class' => 'table table-bordered'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'ФИО',
                'format'=>'raw',
                'value' => function($model){
                    return $model->surname.' '.$model->name.' '.$model->midname;
                }
            ],
            [
                'label' => 'Моб. телефон',
                'format' => 'raw',
                'value' => function($model){
                    $data = '';
                    foreach ($model->contacts as $item) {
                        if ($item->ref_contact_type_id === 1) {
                            $data .= $item->name.Html::tag('br');
                        }
                    }    
                    return $data;
                }
            ],        
            [
                'label' => 'Раб. телефон',
                'format' => 'raw',
                'value' => function($model){
                    $data = '';
                    foreach ($model->contacts as $item) {
                        if ($item->ref_contact_type_id === 3) {
                            $data .= $item->name.Html::tag('br');
                        }
                    }    
                    return $data;
                }
            ],        
            [
                'label' => 'e-mail',
                'format' => 'raw',
                'value' => function($model){
                    $data = '';
                    foreach ($model->contacts as $item) {
                        if ($item->ref_contact_type_id === 2) {
                            $data .= $item->name.Html::tag('br');
                        }
                    }    
                    return $data;
                }
            ],        
            [
                'label' => 'Компания',
                'format' => 'raw',
                'value' => function($model){
                    $data = '';
                    foreach ($model->personsCompanies as $item) {
                        $data .= $item->name.Html::tag('br');
                    }    
                    return $data;
                }
            ],        
            [
                'label' => 'Регион',
                'format' => 'raw',
                'value' => function($model){
                    $data = '';
                    foreach ($model->personsRegions as $item) {
                        $data .= $item->name.Html::tag('br');
                    }    
                    return $data;
                }
            ],        
            [
                'label' => 'Нас. пункт',
                'format' => 'raw',
                'value' => function($model){
                    $data = '';
                    foreach ($model->personsCities as $item) {
                        $data .= substr($item->refCityType->name,0,2).'. '.$item->name.Html::tag('br');
                    }    
                    return $data;
                }
            ],        
            [
                'label' => 'Площадка',
                'format' => 'raw',
                'value' => function($model){
                    $data = '';
                    foreach ($model->personsPlaces as $item) {
                        $data .= $item->name.Html::tag('br');
                    }    
                    return $data;
                }
            ],        
            [
                'label' => 'Сервис',
                'format' => 'raw',
                'value' => function($model){
                    $data = '';
                    foreach ($model->personsServices as $item) {
                        $data .= $item->name.Html::tag('br');
                    }    
                    return $data;
                }
            ],
        ],
    ]); ?> 
    </div>    
</div>
