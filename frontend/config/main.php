<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'name' => 'Pereskazka Shop',
    'sourceLanguage' => 'ru',
    'language' => 'ru-RU',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-public',
            'baseUrl' => '',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
            'loginUrl' => ['/auth/login'],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'session-public',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            // 'suffix' => '/',
            'rules' => [
                // '<alias:\w+>',

               // ['class' => 'frontend\components\AliasesUrlRule'],

                // Site controller
                '' => 'site/index',
                'GET home' => 'site/index',
                'GET,POST contact' => 'site/contact',
                'GET about' => 'site/about',

                // Auth controller
                'login' => 'auth/login',
                'request-password-reset' => 'auth/request-password-reset',
                'reset-password' => 'auth/reset-password',
                'sign-up' => 'auth/signup',

                // Cart controller
                'DELETE cart/<cart:\d+>' => 'cart/delete',                          // Удалить товар из корзины                 | cart_id
                'PUT,POST cart/<product:\d+>' => 'cart/create',                     // Добавить товар в корзину (add ~ create)  | product_id
                'GET cart' => 'cart/index',                                         // Страница корзины

                // Account controller
                'GET account' => 'account/index',

                'GET messages' => 'account/message',                                // Список сообщений
                'GET messages/<method:view>/<id:\d+>' => 'account/message',         // Просмотр сообщения (id)
                'PUT,POST messages/<method:create>' => 'account/message',           // Создание сообщения
                'PUT,POST messages/<method:update>/<id:\d+>' => 'account/message',  // Редактирование сообщения (id)
                'DELETE messages/<method:delete>/<id:\d+>' => 'account/message',    // Удаление сообщения (id)

                'GET orders' => 'account/order',                                                        // Список заказов, отследить заказ
                'GET payments' => 'account/payment',                                                    // Оплата

                'GET,POST settings' => 'account/setting',                                          // Настройки аккаунта
                // 'GET,POST settings/<setting:\w+>' => 'account/setting',

                // OAuth controller
                'GET oauth-vk' => 'oauth/vk',                                                           // Авторизация ВК
                'GET oauth-instagram' => 'oauth/instagram',                                             // Авторизация Инстаграм
                'GET oauth-twitter' => 'oauth/twitter',                                                 // Авторизация Твиттер
                'GET oauth/result/<method:\w+>' => 'oauth/result',                                      // site.ru/oauth/result/(vk|instagram|twitter)
                // Manufacturer controller
                'GET manufacturer/<id:[\w_-]+>' => 'manufacturer/view',
                'GET manufacturer' => 'manufacturer/index',

                // Product controller
                /*'GET catalog' => 'product/index',                                                       // Все товары               | site.ru/catalog                               | site.ru/index.php?r=product/index
                'GET catalog/<sort:\w+>.<field:\w+>' => 'product/index',                                // Сортировка товаров       | site.ru/catalog/sort.field                    | site.ru/index.php?r=product/index?sort=<desc|asc>&field=<name|price|likes|sale|sort_order>
                'GET catalog/<sort:\w+>.<field:\w+>/page_<page:\d+>' => 'product/index',                // Разбивка по страницам    | site.ru/catalog/sort.field/paginate           | site.ru/index.php?r=product/index?sort=<desc|asc>&field=<name|price|likes|sale|sort_order>&paginate=<current_page>

                'GET catalog/<category:\w+>' => 'product/index',                                        // Товары и категории       | site.ru/catalog/category                      | site.ru/index.php?r=product/index?category=<alias|id>
                'GET catalog/<category:\w+>/<sort:\w+>.<field:\w+>' => 'product/index',                 // Сортировка товаров       | site.ru/catalog/category/sort.field           | site.ru/index.php?r=product/index?category=<alias|id>&sort=<desc|asc>&field=<name|price|likes|sale|sort_order>
                'GET catalog/<category:\w+>/<sort:\w+>.<field:\w+>/page_<page:\d+>' => 'product/index', // Разбивка по страницам    | site.ru/catalog/category/sort.field/paginate  | site.ru/index.php?r=product/index?category=<alias|id>&sort=<desc|asc>&field=<name|price|likes|sale|sort_order>&paginate=<current_page>
*/
                'catalog/add/<id:[\w_-]+>' => 'product/cart',
                'catalog/<action:like>' => 'product/<action>',
                'catalog/<category:[\w_\/-]+>/<product:[\w_-]+>' => 'product/view',
                'catalog/<category:[\w_\/-]+>' => 'product/category',
                //'catalog/<product:[\w_-]+>' => 'product/view',
                'catalog' => 'product/index',

                //'GET product/<product:\w+>' => 'product/view',                                          // site.ru/product/product | site.ru/index.php?r=product/view?product=<alias|id>

                //'POST product/cart/<id:\b+>' => 'product/cart',                                    // Открытие модального окна с опциями товара | AJAX site.ru/product/cart/<id> | site.ru/index.php?r=product/cart&id=<id>



                // Auto generate
                //['class' => 'frontend\components\AliasesUrlRule'],
                //['class' => 'frontend\components\aliases\StrictParseRequest'],
            ],
        ],
    ],
    'params' => $params,
];
