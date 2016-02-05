<?php

    namespace app\modules\ffClient\controllers;

    use app\modules\ffClient\Module;
    use yii\helpers\ArrayHelper;
    use yii\web\Controller;
    use yii\web\HttpException;

    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 22.01.2016
     * Time: 16:45
     */
    class BaseController extends Controller
    {
        /**
         * @var Module
         */
        public $client;

        public function init()
        {
            $this->client = \Yii::$app->getModule('ffClient');

            parent::init();
        }

        /**
         * @param $route
         * @param string|array|null $data
         *
         * @return mixed
         */
        public function doRequest($route, $data = null, $method = null)
        {
            $response = $this->client->doRequest($route, $data, $method);
            $this->checkHttpError($response);
            return $response;
        }

        /**
         * Get user attributes from ffClient module
         * @return array
         */
        public function getUserAttributes()
        {
            return $this->client->userAttributes;
        }

        /**
         * @param $route
         *
         * @return mixed
         */
        public function getApiRoute($route)
        {
            return $this->client->getApiRoute($route);
        }

        /**
         * @param $response
         */
        public function checkHttpError($response)
        {
            if (is_object($response)) {
                $response = (array)$response;
            }

            if (ArrayHelper::getValue($response, 'message') && ArrayHelper::getValue($response, 'status')) {
                throw new HttpException($response['status'], $response['message']);
            }
        }

    }