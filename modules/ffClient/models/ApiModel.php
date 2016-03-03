<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 10.02.2016
     * Time: 11:48
     */

    namespace app\modules\ffClient\models;

    use app\modules\ffClient\components\ApiErrorBehavior;
    use app\modules\ffClient\Module;
    use yii\base\DynamicModel;
    use yii\base\Exception;
    use yii\helpers\ArrayHelper;
    use yii\web\HttpException;

    /**
     * Class ApiModel
     * @package app\modules\ffClient\models
     *
     * @method checkApiErrors($response)
     */
    class ApiModel extends DynamicModel
    {
        /**
         * API routes
         */
        const ROUTE_INDEX = null;
        const ROUTE_VIEW = null;
        const ROUTE_UPDATE = null;
        const ROUTE_CREATE = null;
        const METHOD_SAVE = "POST";
        const METHOD_CREATE = "PATCH";

        /**
         * Default filter for API request
         * @var array
         */
        protected static $defaultFilter = [];

        /**
         * @inheritdoc
         */
        public function behaviors()
        {
            return [
                ApiErrorBehavior::className(),
            ];
        }

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
                $message = "FF API ERROR: ".$response['message'];
                $status = $response['status'];
                if ($type = ArrayHelper::getValue($response, 'type')) {
                    throw new $type($message);
                }
                throw new HttpException($status, $message);
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
            if (static::ROUTE_INDEX === null) {
                throw new Exception('Please, specify ROUTE_INDEX in '.static::className());
            }
            $filter = ArrayHelper::merge(static::$defaultFilter, $get);
            $url = self::getApiRoute(static::ROUTE_INDEX, $filter);

            $response = self::doRequest($url);
            $models = [];
            foreach ($response as $item) {
                $models[] = new static((array)$item);
            }

            return $models;
        }

        /**
         * @param array $get
         *
         * @return mixed
         */
        public static function findOne(array $get = [])
        {
            if (static::ROUTE_VIEW === null) {
                throw new Exception('Please, specify ROUTE_VIEW in '.static::className());
            }
            $filter = ArrayHelper::merge(static::$defaultFilter, $get);
            $url = self::getApiRoute(static::ROUTE_VIEW, $filter);

            $response = self::doRequest($url);
            if (ArrayHelper::getValue($response, 'id')) {
                return new static((array)$response);
            }

            return $response;
        }

        /**
         * @param $id
         * @param $data
         *
         * @return mixed
         */
        public static function save($id, $data)
        {
            if (static::ROUTE_UPDATE === null) {
                throw new Exception('Please, specify ROUTE_UPDATE in '.static::className());
            }
            $url = self::getApiRoute(static::ROUTE_UPDATE, ['id' => $id]);
            $response = self::doRequest($url, $data, static::METHOD_SAVE);
            if (isset($response->id)) {
                return new static((array)$response);
            }

            return $response;
        }

        /**
         * @param $data
         *
         * @return mixed
         */
        public static function create($data)
        {
            if (static::ROUTE_CREATE === null) {
                throw new Exception('Please, specify ROUTE_CREATE in '.static::className());
            }
            $url = self::getApiRoute(static::ROUTE_CREATE);
            $response = self::doRequest($url, $data, static::METHOD_CREATE);
            if (isset($response->id)) {
                return new static((array)$response);
            }

            return $response;
        }

        /**
         * @param $field
         * @param array $conditions
         * @param bool $emptyValue
         *
         * @return array
         * @throws \yii\base\Exception
         */
        public static function getList($id, $field, array $conditions = [], $emptyValue = true)
        {
            $outgoings = self::findAll($conditions);
            $result = ArrayHelper::map($outgoings, $id, $field);
            if ($emptyValue) {
                $result = ArrayHelper::merge([0 => "-"], $result);
            }

            return $result;
        }
    }