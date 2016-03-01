<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 29.02.2016
     * Time: 12:34
     */

    namespace app\modules\ffClient\components;

    use app\modules\ffClient\Module;
    use yii\base\Component;

    class Reference extends Component
    {

        /**
         * @return mixed
         */
        public function countriesList()
        {
            /**
             * @var Module $client
             */
            $client = \Yii::$app->getModule('ffClient');
            return $client->doRequest('/api/reference/countries');
        }

        public function deliveryMethods()
        {
            /**
             * @var Module $client
             */
            $client = \Yii::$app->getModule('ffClient');
            return $client->doRequest('/api/reference/delivery-methods');
        }
        
    }