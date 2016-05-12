<?php

    namespace app\modules\ffClient\models\forms;

    use app\models\User;
    use app\modules\ffClient\components\ApiErrorBehavior;
    use yii\base\Model;

    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 01.02.2016
     * Time: 14:29
     *
     * @method checkApiErrors($response)
     */
    class SignupForm extends Model
    {
        public $first_name;
        public $last_name;
        public $email;
        public $password;
        public $ff_id;
        public $api_key;

        /**
         * @inheritdoc
         */
        public function rules()
        {
            return [
                [['first_name', 'last_name'], 'filter', 'filter' => 'trim'],
                [['first_name', 'last_name'], 'required'],
                [['first_name', 'last_name', 'api_key'], 'string', 'min' => 2, 'max' => 255],
                ['email', 'filter', 'filter' => 'trim'],
                ['email', 'required'],
                ['email', 'email'],
                ['email', 'string', 'max' => 255],
                [
                    'email',
                    'unique',
                    'targetClass' => 'app\models\User',
                    'message'     => 'This email address has already been taken.',
                ],
                ['password', 'required'],
                ['password', 'string', 'min' => 6],
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
         * Signs user up.
         *
         * @return \app\models\User|null the saved model or null if saving fails
         */
        public function signup()
        {
            if (!$this->validate()) {
                return null;
            }

            $user = new User();
            $user->first_name = $this->first_name;
            $user->last_name = $this->last_name;
            $user->email = $this->email;
            $user->ff_id = $this->ff_id;
            $user->api_key = $this->api_key;
            $user->setPassword($this->password);
            $user->generateAuthKey();

            return $user->save() ? $user : null;
        }
    }