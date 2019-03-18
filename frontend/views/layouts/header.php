<?php
use yii\helpers\Html;
use frontend\models\User;
use yii\bootstrap\Modal;

/* @var $this \yii\web\View */
/* @var $content string */
?>
<?php if (!Yii::$app->user->isGuest) :?>
<?= Modal::widget([
    'id' => 'modal-user-self-update',
    'header' => Html::tag('h4', Html::encode('Изменить данные'),['class' => 'username'])
])?>
<?php endif ?>

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
                            <li><?= Html::a(
                                    'Изменить данные',
                                    ['/user/management/self-update'],
                                    [
                                        'data-toggle' => 'modal',
                                        'data-target' => '#modal-user-self-update',
                                        'onclick' => 
                                        "$('#modal-user-self-update .modal-dialog .modal-content .modal-body').load($(this).attr('href'))",]
                                ) ?></li>
                            <li><?= Html::a(
                                    'Изменить пароль',
                                    ['/user/management/change-self-password'],
                                    [
                                        'data-toggle' => 'modal',
                                        'data-target' => '#modal-user-self-update',
                                        'onclick' => 
                                        "$('#modal-user-self-update .modal-dialog .modal-content .modal-body').load($(this).attr('href'))",]
                                ) ?></a></li>
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