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
    use yii\helpers\VarDumper;

    class UserForm extends DynamicModel
    {
        public function __construct($attr = [], $config = [])
        {
            /**
             * @var Module $ffClient
             */
            $ffClient = \Yii::$app->getModule('ffClient');
            /**
             * Set all attributes as safe
             */
            $this->addRule($ffClient->userAttributes, 'safe');
            /**
             * Init attributes from ff-client module
             */
            if($attr === []) {
                $attr = $ffClient->userAttributes;
            }

            parent::__construct($attr, $config);
        }

        /**
         * @param $errors
         */
        public function checkApiErrors($errors)
        {
            foreach ($errors as $error) {
                if ($field = ArrayHelper::getValue($error, 'field')) {
                    $msg = ArrayHelper::getValue($error, 'message');
                    $this->addError($field, $msg);
                }
            }
        }

        /**
         * @return string
         */
        public function getUserName()
        {
            return trim($this->first_name." ".$this->last_name);
        }

    }
