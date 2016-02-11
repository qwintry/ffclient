<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 10.02.2016
     * Time: 11:48
     */

    namespace app\modules\ffClient\models;

    use app\modules\ffClient\Module;
    use yii\base\DynamicModel;
    use yii\base\Exception;
    use yii\helpers\ArrayHelper;
    use yii\web\HttpException;

    /**
     * Class ApiModel
     * @package app\modules\ffClient\models
     */
    class ApiModel extends DynamicModel
    {
        /**
         * API routes
         */
        protected static $indexRoute;
        protected static $viewRoute;
        protected static $updateRoute;
        protected static $createRoute;

        protected static $saveMethod = 'PATCH';
        protected static $createMethod = 'POST';

        /**
         * Default filter for API request
         * @var array
         */
        protected static $defaultFilter = [];

        /**
         * @param $route
         * @param string|array|null $data
         *
         * @return mixed
         */
        public static function doRequest($route, $data = null, $method = null)
        {
            /**
             * @var Module $client
             */
            $client = \Yii::$app->getModule('ffClient');
            $response = $client->doRequest($route, $data, $method);
            self::checkHttpError($response);

            return $response;
        }

        /**
         * @param $route
         *
         * @return mixed
         */
        public static function getApiRoute($route, array $get = [])
        {
            /**
             * @var Module $client
             */
            $client = \Yii::$app->getModule('ffClient');

            return $client->getApiRoute($route)."?".http_build_query($get);
        }

        /**
         * @param $response
         */
        public static function checkHttpError($response)
        {
            if (is_object($response)) {
                $response = (array)$response;
            }

            if (ArrayHelper::getValue($response, 'message') && ArrayHelper::getValue($response, 'status')) {
                throw new HttpException($response['status'], $response['message']);
            }
            if (ArrayHelper::getValue($response, 'message') && ArrayHelper::getValue($response, 'stack-trace')) {
                throw new HttpException(500, $response['message']);
            }
        }

        /**
         * @param array $get
         *
         * @return mixed
         */
        public static function findAll(array $get = [])
        {
            if (static::$indexRoute === null) {
                throw new Exception('Please, specify $indexRoute in '.static::className());
            }
            $filter = ArrayHelper::merge(static::$defaultFilter, $get);
            $url = self::getApiRoute(static::$indexRoute, $filter);

            return self::doRequest($url);
        }

        /**
         * @param array $get
         *
         * @return mixed
         */
        public static function findOne(array $get = [])
        {
            if (static::$viewRoute === null) {
                throw new Exception('Please, specify $viewRoute in '.static::className());
            }
            $filter = ArrayHelper::merge(static::$defaultFilter, $get);
            $url = self::getApiRoute(static::$viewRoute, $filter);

            return self::doRequest($url);
        }

        /**
         * @param $id
         * @param $data
         *
         * @return mixed
         */
        public static function save($id, $data)
        {
            if (static::$updateRoute === null) {
                throw new Exception('Please, specify $updateRoute in '.static::className());
            }
            $url = self::getApiRoute(static::$updateRoute, ['id' => $id]);

            return self::doRequest($url, $data, static::$saveMethod);
        }

        /**
         * @param $data
         *
         * @return mixed
         */
        public static function create($data)
        {
            if (static::$createRoute === null) {
                throw new Exception('Please, specify $createRoute in '.static::className());
            }
            $url = self::getApiRoute(static::$createRoute);

            return self::doRequest($url, $data, static::$createMethod);
        }
    }