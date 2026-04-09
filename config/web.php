<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => 'site/index',
    'layout' => 'main',
    'language' => 'ru',
    'name' => 'Base',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@pic' => '/images',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'JW-88ReA8_xGU8-LOLh8pnnwxG_njysc',
            'baseUrl' => '',
            'enableCsrfValidation' => false,
        ],
        'assetManager' => [
            'bundles' => [
                // Отключаем Bootstrap из yii\bootstrap или kartik\*
                'yii\bootstrap5\BootstrapAsset' => false,
                'yii\bootstrap5\BootstrapPluginAsset' => false,

            ],
        ],
        'view' => [
            'class' => 'yii\web\View',
            'renderers' => [
                'twig' => [
                    'class' => 'yii\twig\ViewRenderer',
                    'cachePath' => '@runtime/Twig/cache',
                    // Array of twig options:
                    'options' => [
                        'auto_reload' => true,
                    ],
                    'globals' => [
                        'html' => ['class' => '\yii\helpers\Html'],
                    ],
                    'uses' => ['yii\bootstrap'],
                ],
                // ...
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => false,
            'loginUrl' => ['/site/login'],
            'idParam' => '__user_id',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

use yii\grid\GridView;
use yii\widgets\DetailView;

Yii::$container->set(GridView::class, [
    'tableOptions' => ['class' => 'table table-bordered  table-sm'],
    'layout' => "{items}\n{pager}",
    'pager' => [
        'class' => \yii\widgets\LinkPager::class,
        'maxButtonCount' => 5,
        'options' => ['class' => 'pagination pagination-sm justify-content-center'],
    ],
]);

Yii::$container->set(DetailView::class, [
    'options' => ['class' => 'table table-bordered table-hover'],
]);

return $config;
