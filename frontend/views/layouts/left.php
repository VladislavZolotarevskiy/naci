<?php
use yii\helpers\Url;
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
                        [
                'options' => [
                    'class' => 'sidebar-menu tree',
                    'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Главное меню', 
                        'options' => [
                            'class' => 'header']],
                    [
                        'label' => 'Справочники',
                        'icon' => 'list',
                        'items' => [
                            ['label' => 'Регионы', 'icon' => 'caret-right',
                                'url' => ['/ref-region'],],
                            ['label' => 'Сервисы', 'icon' => 'caret-right', 
                                'url' => ['/ref-service'],],
                            ['label' => 'Населённые пункты',
                                'icon' => 'caret-right',
                                'url' => ['/ref-city'],],
                            ['label' => 'Типы населённых пунктов',
                                'icon' => 'caret-right',
                                'url' => ['/ref-city-type'],],
                            ['label' => 'Типы контактов', 
                                'icon' => 'caret-right', 
                                'url' => ['/ref-contact-type'],],
                            ['label' => 'Площадки', 
                                'icon' => 'caret-right',
                                'url' => ['/ref-place'],],
                            ['label' => 'Компании', 
                                'icon' => 'caret-right', 
                                'url' => ['/ref-company'],],
                            ],
                        ],
                    ['label' => 'Сотрудники', 
                        'icon' => 'user',
                        'url' => ['/persons/index']],
                    ['label' => 'Инциденты',
                        'icon' => 'info-circle',
                        'url' => ['/incident/index']],
                ],
            ]
        ) ?>

    </section>

</aside>
