<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrapper">
    <div class="header">
        <?php
        NavBar::begin([
            'brandLabel' => Html::img('@web/images/shop.png', ['alt' => Yii::$app->name]),
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-default',
            ],
        ]);

        $menuItems = [
            ['label' => 'Главная', 'url' => ['/site/index']],
            ['label' => 'Каталог', 'url' => ['/product/index']],
            ['label' => 'Производители', 'url' => ['/manufacturer/index']],
            ['label' => 'Контакты', 'url' => ['/site/contact']],
            ['label' => 'О нас', 'url' => ['/site/about']],
        ];
        
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-left'],
            'items' => $menuItems,
        ]);

        $menuItems = [];

        $menuItems[] = ['label' => 'Корзина', 'url' => ['/cart/index']];

        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Регистрация', 'url' => ['/auth/signup']];
            $menuItems[] = ['label' => 'Вход', 'url' => ['/auth/login']];
        } else {
            $menuItems[] = '<li>'
                . Html::beginForm(['/auth/logout'], 'post')
                . Html::submitButton(
                    'Выйти (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>';
        }

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $menuItems,
        ]);

        NavBar::end();
        ?>
    </div>

    <div id="content">
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>

            <?= Alert::widget() ?>
        </div>

        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">© DefShop 2018</p>

        <p class="pull-right">Powered by <a href="https://voinmerk.ru/" rel="external">voinmerk.ru</a></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
