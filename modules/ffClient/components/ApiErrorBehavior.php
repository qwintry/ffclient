<?php

    namespace app\modules\ffClient\components;

    use yii\base\Model;
    use yii\helpers\ArrayHelper;

    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 03.02.2016
     * Time: 13:43
     */
    class ApiErrorBehavior extends \yii\base\Behavior
    {
        /**
         * @param $errors
         */
        public function checkApiErrors($response)
        {
            foreach ($response as $error) {
                if ($field = ArrayHelper::getValue($error, 'field')) {
                    $msg = ArrayHelper::getValue($error, 'message');
                    /**
                     * @var Model $this->owner
                     */
                    $this->owner->addError($field, $msg);
                }
            }
        }

    }