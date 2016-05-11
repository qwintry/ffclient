<?php

    $params = require(__DIR__.'/params.php');

    $config = [
        'id'         => 'ff-client',
        'name' => 'FF Client',
        'basePath'   => dirname(__DIR__),
        'bootstrap'  => ['log'],
        'components' => [
            'request'      => [
                // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
                'cookieValidationKey' => 'j-2ubKVs7iiN5Gp1Beq5LePkqAkjtL6g',
            ],
            'cache'        => [
                'class' => 'yii\caching\FileCache',
            ],
            'user'         => [
                'class' => 'app\components\User',
                'identityClass'   => 'app\models\User',
                'enableAutoLogin' => true,
            ],
            'errorHandler' => [
                'errorAction' => 'site/error',
            ],
            'mailer'       => [
                'class'            => 'yii\swiftmailer\Mailer',
                // send all mails to a file by default. You have to set
                // 'useFileTransport' to false and configure a transport
                // for the mailer to send real emails.
                'useFileTransport' => true,
            ],
            'log'          => [
                'traceLevel' => YII_DEBUG ? 3 : 0,
                'targets'    => [
                    [
                        'class'  => 'yii\log\FileTarget',
                        'levels' => ['error', 'warning'],
                    ],
                ],
            ],
            'urlManager' => [
                'enablePrettyUrl' => true,
                'showScriptName' => false,
                'rules' => [
                    //remove id from get params
                    '<controller:[\w-]+>' => 'ffClient/<controller>/index',
                    '<controller:[\w-]+>/<id:\d+>' => 'ffClient/<controller>/view',
                    '<controller:[\w-]+>/<id:\d+>/<action:\w+>' => 'ffClient/<controller>/<action>',
                    '<controller:[\w-]+>/<action:[\w-]+>' => 'ffClient/<controller>/<action>',
                ],
            ],
            'db'           => require(__DIR__.'/db.php'),
        ],
        'modules'    => [
        ],
        'params'     => $params,
    ];

    //merge api connector
    if(file_exists(__DIR__."/api-connect.php")) {
        $config  = array_merge($config, require __DIR__."/api-connect.php");
    }

    if (YII_ENV_DEV) {
        // configuration adjustments for 'dev' environment
        $config['bootstrap'][] = 'debug';
        $config['modules']['debug'] = [
            'class' => 'yii\debug\Module',
        ];

        $config['bootstrap'][] = 'gii';
        $config['modules']['gii'] = [
            'class' => 'yii\gii\Module',
        ];
    }

    return $config;
