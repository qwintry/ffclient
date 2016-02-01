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

        /**
         * @param $route
         * @param string|array|null $data
         *
         * @return mixed
         */
        public function doRequest($route, $data = null, $method = null)
        {
            /**
             * @var Module $client
             */
            $client = \Yii::$app->getModule('ffClient');
            return $client->doRequest($route, $data, $method);
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
            /**
             * @var Module $ffClient
             */
            $ffClient = \Yii::$app->getModule('ffClient');
            return $ffClient->getApiRoute($route);
        }
    }