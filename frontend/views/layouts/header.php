<?php
use yii\helpers\Html;
use frontend\models\User;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">
    <?= Html::a('<span class="logo-mini">' . Yii::$app->name . '</span><span '
            . 'class="logo-lg">Monitoring</span>', Yii::$app->homeUrl, 
            ['class' => 'logo']) ?>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" 
           role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <?php if (Yii::$app->user->isGuest): ?>
                    <li>
                        <?= Html::a('Войти', '/user/default/login') ?>
                    </li>
                <?php else: ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" 
                           data-toggle="dropdown"><?= User::fullName() ?><span 
                                class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><?= Html::a(
                                    'Выйти',
                                    ['/user/default/logout'],
                                    ['data-method' => 'post']
                                ) ?></li>
                        </ul>
                    </li>
                <?php endif ?>
            </ul>
        </div>    
    </nav>
</header>