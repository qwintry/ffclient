<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 10.02.2016
     * Time: 11:48
     */

    namespace app\modules\ffClient\models;

    use app\modules\ffClient\components\ApiErrorBehavior;
    use yii\base\DynamicModel;

    /**
     * Class ApiModel
     * @package app\modules\ffClient\models
     *
     *
     * @method checkApiErrors($response)
     */
    class ApiModel extends DynamicModel
    {
        /**
         * @inheritdoc
         */
        public function behaviors()
        {
            return [
                ApiErrorBehavior::className(),
            ];
        }
    }