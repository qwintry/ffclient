<?php

    namespace app\modules\ffClient;

    use yii\helpers\ArrayHelper;

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

        /**
         * @param $route
         * @param null $data
         * @param null $method
         *
         * @return mixed
         */
        public function doRequest($route, $data = null, $method = null)
        {
            $url = $this->siteUrl.'/'.ltrim($route, "/");

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$this->apiKey));

            if($method) {
                if($method == "POST") {
                    curl_setopt($ch, CURLOPT_POST, true);
                } else {
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
                }
            }

            if($data) {
                if(is_array($data)) {
                    $data = http_build_query($data);
                }
                if($method === null) {
                    curl_setopt($ch, CURLOPT_POST, true);
                }
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            }
            curl_setopt($ch, CURLOPT_USERAGENT, 'FF API Client 1.0');
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            $response = curl_exec($ch);
            curl_close($ch);

            return json_decode($response);
        }

        /**
         * @param $route
         *
         * @return mixed
         */
        public function getApiRoute($route)
        {
            return ArrayHelper::getValue($this->routes, $route);
        }
    }
