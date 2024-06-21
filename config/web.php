<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$dbSso = require __DIR__ . '/dbSso.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'timeZone' => 'Asia/Jakarta',
    'components' => [
        'formatter' => [
            'dateFormat' => 'php:d-m-Y',
            'datetimeFormat' => 'php:d-m-Y H:i:s',
            'timeFormat' => 'php:H:i:s',
            'numberFormatterSymbols' => [
                // \NumberFormatter::CURRENCY_SYMBOL => ''
            ],
            'numberFormatterOptions' => [
                // NumberFormatter::MIN_FRACTION_DIGITS => 0,
                // NumberFormatter::MAX_FRACTION_DIGITS => 2,
            ],
            'defaultTimeZone' => 'Asia/Jakarta',
            'nullDisplay' => '',
            'currencyCode' => 'IDR',
            'decimalSeparator' => '.',
            'locale' => 'id',
            'thousandSeparator' => ',',
        ],
        'request' => [
            //            'baseUrl' => '/akn',

            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'sso',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'class' => 'app\models\User',
            'identityClass' => 'app\models\Identitas',
            'enableAutoLogin' => true,
            'loginUrl' => '@.sso/masuk?b=http://presensi.rsud-arifin.apps',
            'identityCookie' => ['name' => '_identity-id', 'httpOnly' => true, 'domain' => 'rsud-arifin.apps'],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
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
        'dbSso' => $dbSso,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            //            'suffix' => '.html',
            'rules' => [
                '' => 'site/index',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',                 // only for integer id
                '<controller:\w+>/<action:\w+[-\w]+\w>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+[-\w]+\w>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>s' => '<controller>/index',
            ],
        ],
    ],
    'container' => [
        'definitions' => [
            // app\components\number\KyNumber::class => [
            //     'maskedInputOptions' => [
            //         // 'prefix' => 'Rp ',
            //         // 'alias' => 'numeric',
            //         'positionCaretOnClick' => 'none',
            //         'groupSeparator' => '.',
            //         'radixPoint' => ',',
            //         'allowMinus' => false,
            //         'unmaskAsNumber' => true, // untuk ambil unmasked value sebagai number,
            //     ],
            //     'displayOptions' => ['class' => 'form-control form-control-sm', 'autocomplete' => 'off'],
            //     'options' => [
            //         'type' => 'hidden',
            //         // 'label' => '<label>Saved Value: </label>',
            //         'label' => null,
            //         'class' => 'kv-saved',
            //         'readonly' => true,
            //         'tabindex' => 1000
            //     ],
            //     'saveInputContainer' => ['class' => 'kv-saved-cont'],
            // ],
            yii\grid\ActionColumn::class => [
                'class' => 'app\components\ActionColumn',
                'headerOptions' => [
                    'class' => 'bg-lightblue'
                ],
                'contentOptions' => [
                    'class' => 'action-column',
                    'style' => 'text-align: center;'
                ],
            ],

            yii\grid\DataColumn::class => [
                'filterInputOptions' => [
                    'class' => 'form-control form-control-sm',
                    'autocomplete' => 'off'
                ],
                'headerOptions' => [
                    // 'class' => 'bg-lightblue'
                ],
                'contentOptions' => [
                    // 'style' => 'white-space: nowrap;',
                    // 'class' => 'action-column',
                    'style' => 'overflow: hidden; text-overflow: ellipsis;',
                ]
            ],


        ],
    ],
    'params' => $params,
    'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
            // enter optional module parameters below - only if you need to  
            // use your own export download action or custom translation 
            // message source
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ]
    ],
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

return $config;
