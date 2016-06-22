<?php

    namespace app\models\forms\profile;

    use app\modules\ffClient\components\ApiErrorBehavior;
    use app\modules\ffClient\models\User;
    use app\modules\ffClient\Module;
    use yii\base\Model;
    use yii\helpers\ArrayHelper;

    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 21.06.2016
     * Time: 12:03
     *
     *
     * @method checkApiErrors($response)
     * @see [[ApiErrorBehavior::checkApiErrors]]
     */
    class ActivationForm extends Model
    {
        /**
         * @var string
         */
        public $firstName;

        /**
         * @var string
         */
        public $lastName;
        /**
         * @var string
         */
        public $password;

        /**
         * @inheritdoc
         * @return array
         */
        public function rules()
        {
            return [
                [['firstName', 'lastName'], 'required'],
                ['password', 'string', 'min' => 6, 'max' => 20],
                [['firstName', 'lastName'], 'string', 'max' => 100],
                [
                    ['firstName', 'lastName'],
                    'match',
                    'pattern' => '/^[A-Za-z0-9\s\-\_\!\.\,\?\:\/]*$/',
                    'message' => \Yii::t('profile', 'Only english symbols is allowed!'),
                ],
            ];
        }

        /**
         * @return array
         */
        public function attributeLabels()
        {
            return [
                'firstName' => \Yii::t('profile', 'First Name'),
                'lastName'  => \Yii::t('profile', 'Last Name'),
                'password'  => \Yii::t('profile', 'Password'),
            ];
        }

        /**
         * @inheritdoc
         * @return array
         */
        public function behaviors()
        {
            return [
                ApiErrorBehavior::className(),
            ];
        }

        /**
         * @return bool
         */
        public function updateUser()
        {
            /**
             * @var User $user
             */
            $user = \Yii::$app->user->identity;
            if ($this->password) {
                $user->setPassword($this->password);
            }
            $user->first_name = $this->firstName;
            $user->last_name = $this->lastName;

            //send data to ff api and check errors
            /**
             * @var Module $ffClient
             */
            $ffClient = \Yii::$app->getModule('ffClient');
            $response = $ffClient->doRequest(Module::ROUTE_USER_CREATE, $user->getAttributes());
            $this->checkApiErrors($response);

            if($this->hasErrors()) {
                return false;
            }
            $user->ff_id = ArrayHelper::getValue($response, 'id');

            if (!$user->save()) {
                $this->addErrors($user->getErrors());

                return false;
            }

            if ($this->password) {
                $this->_sendUpdateEmail();
            }

            return true;
        }

        /**
         * @return bool
         */
        private function _sendUpdateEmail()
        {
            $lang = \Yii::$app->language;
            /**
             * @var User $user
             */
            $user = \Yii::$app->user->identity;

            return \Yii::$app->mailer->compose('@app/modules/ffClient/mail/'.$lang.'/auth-data', [
                'email'    => $user->email,
                'password' => $this->password,
            ])->setTo($user->email)->setFrom(\Yii::$app->params['supportEmail'])->setSubject(\Yii::t('profile',
                'Update account on {name}', ['name' => \Yii::$app->name]))->send();
        }
    }