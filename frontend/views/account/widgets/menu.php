<?php

use yii\bootstrap\Nav;

/*use yii\helpers\Html;
use yii\helpers\Url;*/

$userMenu = [
    ['label' => 'Профиль', 'url' => ['/account/index']],
    ['label' => 'Заказы', 'url' => ['/account/order']],
    ['label' => 'Сообщения', 'url' => ['/account/message']],
    ['label' => 'Оплата', 'url' => ['/account/payment']],
    ['label' => 'Настройки', 'url' => ['/account/setting']],
];

echo Nav::widget([
    'options' => ['class' => 'user-menu'],
    'items' => $userMenu,
]);