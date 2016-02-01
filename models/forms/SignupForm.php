<?php

    namespace app\models\forms;

    use app\models\User;
    use yii\base\Model;
    use yii\helpers\ArrayHelper;

    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 01.02.2016
     * Time: 14:29
     */
    class SignupForm extends Model
    {
        public $first_name;
        public $last_name;
        public $email;
        public $password;
        public $ff_id;

        /**
         * @inheritdoc
         */
        public function rules()
        {
            return [
                [['first_name', 'last_name'], 'filter', 'filter' => 'trim'],
                [['first_name', 'last_name'], 'required'],
                [
                    ['first_name', 'last_name'],
                    'unique',
                    'targetClass' => 'app\models\User',
                    'message'     => 'This username has already been taken.',
                ],
                [['first_name', 'last_name'], 'string', 'min' => 2, 'max' => 255],
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
            $user->setPassword($this->password);
            $user->generateAuthKey();

            return $user->save() ? $user : null;
        }

        /**
         * @param $errors
         */
        public function checkApiErrors($response)
        {
            foreach ($response as $error) {
                if ($field = ArrayHelper::getValue($error, 'field')) {
                    $msg = ArrayHelper::getValue($error, 'message');
                    $this->addError($field, $msg);
                }
            }
        }
    }