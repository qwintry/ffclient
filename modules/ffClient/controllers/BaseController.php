<?php

    namespace app\modules\ffClient\controllers;

    use app\modules\ffClient\models\forms\ApiForm;
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
        public function getApiRoute($route, array $get = [])
        {
            return $this->client->getApiRoute($route).(count($get) ? "?".http_build_query($get) : "");
        }

        /**
         * @param $response
         *
         * @throws \yii\web\HttpException
         */
        public function checkHttpError($response)
        {
            if (is_object($response)) {
                $response = (array)$response;
            }

            if (ArrayHelper::getValue($response, 'message') && ArrayHelper::getValue($response, 'status')) {
                $message = "FF API ERROR: ".$response['message'];
                $status = $response['status'];
                if ($type = ArrayHelper::getValue($response, 'type')) {
                    throw new $type($message);
                }
                throw new HttpException($status, $message);
            }
        }

        /**
         * @param string $modelClass
         * @param null $response
         *
         * @return ApiForm
         */
        public function getForm($modelClass, $id = null)
        {
            $attrs = [];
            $classPieces = explode("\\", $modelClass);
            $class = array_pop($classPieces);
            foreach (Module::$$class as $attr) {
                $attrs[$attr] = null;
            }

            if ($id) {
                $attrs['id'] = $id;
            }

            return new $modelClass($attrs);
        }

    }