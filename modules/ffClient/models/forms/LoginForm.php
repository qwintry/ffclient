<?php

    namespace app\modules\ffClient\models\forms;

    use app\models\User;
    use app\modules\ffClient\Module;
    use Yii;
    use yii\base\Model;
    use yii\helpers\ArrayHelper;
    use yii\helpers\VarDumper;

    /**
     * LoginForm is the model behind the login form.
     */
    class LoginForm extends Model
    {
        public $email;
        public $password;
        public $rememberMe = true;

        private $_user = false;


        /**
         * @return array the validation rules.
         */
        public function rules()
        {
            return [
                // username and password are both required
                [['email', 'password'], 'required'],
                ['email', 'email'],
                // rememberMe must be a boolean value
                ['rememberMe', 'boolean'],
                // password is validated by validatePassword()
                ['password', 'validatePassword'],
            ];
        }

        /**
         * Validates the password.
         * This method serves as the inline validation for password.
         *
         * @param string $attribute the attribute currently being validated
         * @param array $params     the additional name-value pairs given in the rule
         */
        public function validatePassword($attribute, $params)
        {
            if (!$this->hasErrors()) {
                $user = $this->getUser();

                if (!$user || !$user->validatePassword($this->password)) {
                    $this->addError($attribute, 'Incorrect username or password.');
                }
            }
        }

        /**
         * Logs in a user using the provided username and password.
         * @return boolean whether the user is logged in successfully
         */
        public function login()
        {
            if ($this->validate()) {
                return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
            }

            return false;
        }

        /**
         * Finds user by [[username]]
         *
         * @return User|null
         */
        public function getUser()
        {
            if ($this->_user === false) {
                $user = User::findOne(['email' => $this->email]);
                //if user not exists in client db, try to find him via ff api
                if(!$user) {
                    /**
                     * @var Module $client
                     */
                    $client = Yii::$app->getModule('ffClient');
                    $url = $client->getApiRoute('user_index')."?email=".$this->email;
                    $response = $client->doRequest($url);
                    if($ffUser = ArrayHelper::getValue($response, 0)) {
                        $ffUser = (array)$ffUser;
                        $ffUser['ff_id'] = $ffUser['id'];
                        unset($ffUser['id']);
                        $user = new User();
                        $user->setAttributes($ffUser);
                        $user->setPassword(Yii::$app->security->generateRandomString(6));
                        $user->generateAuthKey();
                        $user->save(false);
                        $this->addError('password', 'You must reset your password');
                    }
                }
                $this->_user = $user;
            }

            return $this->_user;
        }
    }
