<?php

    namespace app\models\forms\profile;

    use app\modules\ffClient\models\User;
    use app\modules\ffClient\Module;
    use yii\base\Model;

    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 21.06.2016
     * Time: 12:03
     */
    class RegistrationForm extends Model
    {
        /**
         * @var string
         */
        public $email;

        /**
         * @var bool
         */
        public $isAgreementAccepted;
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
                ['email', 'required'],
                ['email', 'email'],
                ['email', 'unique', 'targetClass' => User::className(), 'targetAttribute' => 'email'],

                ['isAgreementAccepted', 'boolean'],
                [
                    'isAgreementAccepted',
                    'compare',
                    'compareValue' => 1,
                    'message'      => \Yii::t("profile", "Check out the terms of use"),
                ],
            ];
        }

        /**
         * @return array
         */
        public function attributeLabels()
        {
            return [
                'email'               => \Yii::t('profile', 'E-mail'),
                'isAgreementAccepted' => \Yii::t('profile', 'I agree to terms and agreements'),
            ];
        }

        /**
         * @return bool
         */
        public function registerUser()
        {
            $user = new User();
            $user->email = $this->email;
            $this->password = \Yii::$app->security->generateRandomString(8);
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->first_name = explode('@', $this->email)[0];

            if (!$user->save()) {
                $this->addErrors($user->getErrors());

                return false;
            }

            $this->_sendRegistrationEmail();
            $this->_sendAuthDataEmail();

            //authorization
            \Yii::$app->user->login($user, 3600);

            return true;
        }

        /**
         * @return bool
         */
        private function _sendRegistrationEmail()
        {
            $lang = \Yii::$app->language;

            return \Yii::$app->mailer->compose('@app/modules/ffClient/mail/'.$lang.'/registration', [
                    'model' => $this,
                ])->setTo($this->email)->setFrom(\Yii::$app->params['supportEmail'])->setSubject(\Yii::t('profile',
                    'Registration on '.\Yii::$app->name))->send();
        }

        /**
         * @return bool
         */
        private function _sendAuthDataEmail()
        {
            $lang = \Yii::$app->language;

            return \Yii::$app->mailer->compose('@app/modules/ffClient/mail/'.$lang.'/auth-data', [
                'email' => $this->email,
                'password' => $this->password,
            ])->setTo($this->email)->setFrom(\Yii::$app->params['supportEmail'])->setSubject(\Yii::t('profile',
                'Registration on {name}', ['name' => \Yii::$app->name]))->send();
        }
    }