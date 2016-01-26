<?php

    namespace app\modules\ffClient;

    class Module extends \yii\base\Module
    {
        public $controllerNamespace = 'app\modules\ffClient\controllers';

        /**
         * Key for access to qwintry fulfillment api
         * @var string
         */
        public $apiKey;
        /**
         * Url of qwintry fulfillment api
         * @var string
         */
        public $siteUrl;

        /**
         * User attributes
         * @var array
         */
        public $userAttributes = [
            'email',
            'first_name',
            'last_name',
            'balance',
        ];

        /**
         * Api routes
         * @var array
         */
        public $routes = [
            'user_index'  => 'api/user/index',
            'user_create' => 'api/user/create',
            'user_update' => 'api/user/update',
        ];

        public function init()
        {
            parent::init();
            // custom initialization code goes here
        }
    }
