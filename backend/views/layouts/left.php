<?php

use yii\helpers\Url;

$menu_items = [
    'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
    'items' => [
        ['label' => 'Панель состояния', 'icon' => 'dashboard', 'url' => ['/site']],
        [
            'label' => 'Каталог',
            'icon' => 'tags',
            'url' => ['/site'],
            'items' => [
                ['label' => 'Категории', 'icon' => 'circle-o', 'url' => ['/category']],
                ['label' => 'Товары', 'icon' => 'circle-o', 'url' => ['/product']],
                ['label' => 'Производители', 'icon' => 'circle-o', 'url' => ['/manufacturer']],
                ['label' => 'Отзывы', 'icon' => 'circle-o', 'url' => ['/site']],
                ['label' => 'Опции', 'icon' => 'circle-o', 'url' => ['/site']],
                ['label' => 'Баннеры', 'icon' => 'circle-o', 'url' => ['/banner']],
            ],
        ],
        [
            'label' => 'Страницы',
            'icon' => 'file-text',
            'url' => ['/site'],
            'items' => [
                ['label' => 'Записи', 'icon' => 'circle-o', 'url' => ['/post']],
            ],
        ],
        [
            'label' => 'Продажи',
            'icon' => 'shopping-cart',
            'url' => ['/site'],
            'items' => [
                ['label' => 'Заказы', 'icon' => 'circle-o', 'url' => ['/site']],
                ['label' => 'Возвраты', 'icon' => 'circle-o', 'url' => ['/site']],
                ['label' => 'Корзины', 'icon' => 'circle-o', 'url' => ['/site']],
            ],
        ],
        [
            'label' => 'Пользователи',
            'icon' => 'tags',
            'url' => ['/site'],
            'items' => [
                ['label' => 'Пользователи', 'icon' => 'circle-o', 'url' => ['/site']],
                ['label' => 'Группы', 'icon' => 'circle-o', 'url' => ['/site']],
            ],
        ],
        [
            'label' => 'Система',
            'icon' => 'cog',
            'url' => ['/site'],
            'items' => [
                ['label' => 'Настройки', 'icon' => 'circle-o', 'url' => ['/site']],
                ['label' => 'Магазин', 'icon' => 'circle-o', 'url' => ['/site']],
                [
                    'label' => 'Локализация',
                    'icon' => 'circle-o',
                    'url' => ['/site'],
                    'items' => [
                        ['label' => 'Страны', 'icon' => 'circle-o', 'url' => ['/site']],
                        ['label' => 'Регионы', 'icon' => 'circle-o', 'url' => ['/site']],
                        ['label' => 'Города', 'icon' => 'circle-o', 'url' => ['/site']],
                    ],
                ],
            ],
        ],
    ],
];

?>
<aside class="main-sidebar">
    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= $user->first_name ?> <?= $user->last_name ?></p>

                <a href="<?= Url::to(['/account/index']) ?>"><i class="fa fa-circle text-success"></i> <?= $user->username ?></a>
            </div>
        </div>

        <?php if(isset($this->search)) { ?>
        <form id="form-search" action="<?= $this->search['action'] ?>" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="<?= $this->search['text'] ?>" />

                <span class="input-group-btn">
                    <button type="submit" id="search-btn" class="btn btn-flat" data-toggle="tooltip" title="Искать"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <?php } ?>

        <?= dmstr\widgets\Menu::widget($menu_items) ?>
    </section>
</aside>
