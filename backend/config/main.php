<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'name' => 'AdminLte',
    'sourceLanguage' => 'ru',
    'language' => 'ru-RU',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-admin',
            'baseUrl' => '/admin',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
            'loginUrl' => ['/auth/login']
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'session-admin',
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
            'rules' => [
                // Site controller
                '' => 'site/index',
                'index' => 'site/index',
                'dashboard' => 'site/index',
                'error' => 'site/index',

                // Auth controller
                'login' => 'auth/login',
                'logout' => 'auth/logout',

                // Other
                /*'<controller:aliases|banner|category|manufacturer|product|post>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:aliases|banner|category|manufacturer|product|post>/<action:\w+>' => '<controller>/<action>',
                '<controller:aliases|banner|category|manufacturer|product|post>' => '<controller>',*/
            ],
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    //'@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
                    '@app/views' => '@backend/views'
                ],
            ],
        ],
        'assetManager' => [
            'bundles' => [
                /*'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-black',
                ],*/
                'insolita\wgadminlte\CollapseBoxAsset'=>[
                    'depends'=>[
                        'insolita\wgadminlte\JsCookieAsset'
                    ]
                ],
            ],
        ],
    ],
    'params' => $params,
];
