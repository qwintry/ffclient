<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 25.01.2016
     * Time: 11:36
     */

    namespace app\modules\ffClient\models;

    use app\modules\ffClient\Module;
    use yii\base\DynamicModel;
    use yii\helpers\ArrayHelper;

    class UserForm extends DynamicModel
    {
        public function init()
        {
            /**
             * @var Module $ffClient
             */
            $ffClient = \Yii::$app->getModule('ffClient');
            /**
             * Init attributes from ff-client module
             */
            $this->setAttributes($ffClient->userAttributes, false);
            /**
             * Set all attributes as safe
             */
            $this->addRule($ffClient->userAttributes, 'safe');
            
            parent::init();
        }

        /**
         * @param $errors
         */
        public function checkApiErrors($errors) {
            foreach ($errors as $error) {
                if($field = ArrayHelper::getValue($error, 'field')) {
                    $msg = ArrayHelper::getValue($error, 'message');
                    $this->addError($field, $msg);
                }
            }
        }

    }
