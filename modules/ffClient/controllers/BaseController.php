<?php

    namespace app\modules\ffClient\controllers;

    use app\modules\ffClient\Module;
    use yii\helpers\ArrayHelper;
    use yii\web\Controller;

    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 22.01.2016
     * Time: 16:45
     */
    class BaseController extends Controller
    {
        private $_url;
        private $_key;

        protected $apiRoutes;

        public function init()
        {
            parent::init();

            /**
             * @var Module $ffClient;
             */
            $ffClient = \Yii::$app->getModule('ffClient');
            $this->_url = $ffClient->siteUrl;
            $this->_key = $ffClient->apiKey;

            $this->apiRoutes = $ffClient->routes;
        }

        /**
         * @param $route
         * @param string|array|null $data
         *
         * @return mixed
         */
        public function doRequest($route, $data = null, $method = null)
        {
            $url = $this->_url.'/'.ltrim($route, "/");

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$this->_key));

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
         * Get user attributes from ffClient module
         * @return array
         */
        public function getUserAttributes() {
            /**
             * @var Module $ffClient
             */
            $ffClient = \Yii::$app->getModule('ffClient');
            return $ffClient->userAttributes;
        }

        /**
         * @param $route
         *
         * @return mixed
         */
        public function getApiRoute($route)
        {
            return ArrayHelper::getValue($this->apiRoutes, $route);
        }
    }