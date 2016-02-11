<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 10.02.2016
     * Time: 11:48
     */

    namespace app\modules\ffClient\models\forms;

    use app\modules\ffClient\components\ApiErrorBehavior;
    use yii\base\DynamicModel;

    /**
     * Class ApiForm
     * @package app\modules\ffClient\models\forms
     *
     *
     * @method checkApiErrors($response)
     */
    class ApiForm extends DynamicModel
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