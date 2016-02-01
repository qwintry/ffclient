<?php

    namespace app\models;

    use app\modules\ffClient\Module;
    use Yii;
    use yii\base\NotSupportedException;
    use yii\behaviors\TimestampBehavior;
    use yii\helpers\ArrayHelper;
    use yii\web\IdentityInterface;

    /**
     * This is the model class for table "user".
     *
     * @property integer $id
     * @property string $username
     * @property string $auth_key
     * @property string $password_hash
     * @property string $password_reset_token
     * @property string $email
     * @property integer $status
     * @property integer $created_at
     * @property integer $updated_at
     * @property string $first_name
     * @property string $last_name
     * @property integer $ff_id
     */
    class User extends \yii\db\ActiveRecord implements IdentityInterface
    {
        const STATUS_DELETED = 0;
        const STATUS_ACTIVE = 10;

        /**
         * @inheritdoc
         */
        public static function tableName()
        {
            return 'user';
        }

        /**
         * @inheritdoc
         */
        public function rules()
        {
            return [
                [['first_name', 'last_name', 'auth_key', 'password_hash', 'email'], 'required'],
                [['status', 'created_at', 'updated_at'], 'integer'],
                [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
                [['auth_key'], 'string', 'max' => 32],
                [['username'], 'unique'],
                [['email'], 'unique'],
                [['password_reset_token'], 'unique'],
            ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels()
        {
            return [
                'id'                   => 'ID',
                'username'             => 'Username',
                'auth_key'             => 'Auth Key',
                'password_hash'        => 'Password Hash',
                'password_reset_token' => 'Password Reset Token',
                'email'                => 'Email',
                'status'               => 'Status',
                'created_at'           => 'Created At',
                'updated_at'           => 'Updated At',
            ];
        }

        /**
         * @inheritdoc
         */
        public function behaviors()
        {
            return [
                TimestampBehavior::className(),
            ];
        }

        /**
         * Finds an identity by the given ID.
         *
         * @param string|integer $id the ID to be looked for
         *
         * @return IdentityInterface the identity object that matches the given ID.
         * Null should be returned if such an identity cannot be found
         * or the identity is not in an active state (disabled, deleted, etc.)
         */
        public static function findIdentity($id)
        {
            return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
        }

        /**
         * Finds an identity by the given token.
         *
         * @param mixed $token the token to be looked for
         * @param mixed $type  the type of the token. The value of this parameter depends on the implementation.
         *                     For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
         *
         * @return IdentityInterface the identity object that matches the given token.
         * Null should be returned if such an identity cannot be found
         * or the identity is not in an active state (disabled, deleted, etc.)
         */
        public static function findIdentityByAccessToken($token, $type = null)
        {
            throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
        }

        /**
         * Returns an ID that can uniquely identify a user identity.
         * @return string|integer an ID that uniquely identifies a user identity.
         */
        public function getId()
        {
            return $this->getPrimaryKey();
        }

        /**
         * Returns a key that can be used to check the validity of a given identity ID.
         *
         * The key should be unique for each individual user, and should be persistent
         * so that it can be used to check the validity of the user identity.
         *
         * The space of such keys should be big enough to defeat potential identity attacks.
         *
         * This is required if [[User::enableAutoLogin]] is enabled.
         * @return string a key that is used to check the validity of a given identity ID.
         * @see validateAuthKey()
         */
        public function getAuthKey()
        {
            return $this->auth_key;
        }

        /**
         * Validates the given auth key.
         *
         * This is required if [[User::enableAutoLogin]] is enabled.
         *
         * @param string $authKey the given auth key
         *
         * @return boolean whether the given auth key is valid.
         * @see getAuthKey()
         */
        public function validateAuthKey($authKey)
        {
            return $this->getAuthKey() === $authKey;
        }

        /**
         * Generates password hash from password and sets it to the model
         *
         * @param string $password
         */
        public function setPassword($password)
        {
            $this->password_hash = Yii::$app->security->generatePasswordHash($password);
        }


        /**
         * Generates "remember me" authentication key
         */
        public function generateAuthKey()
        {
            $this->auth_key = Yii::$app->security->generateRandomString();
        }

        /**
         * Finds user by username
         *
         * @param string $username
         * @return static|null
         */
        public static function findByUsername($username)
        {
            return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
        }

        /**
         * Validates password
         *
         * @param string $password password to validate
         * @return boolean if password provided is valid for current user
         */
        public function validatePassword($password)
        {
            return Yii::$app->security->validatePassword($password, $this->password_hash);
        }

        /**
         * @inheritdoc
         * @param bool $insert
         *
         * @return bool
         */
        public function beforeSave($insert)
        {
            if(!$this->isNewRecord) {
                $this->username = $this->generateUsername();
            }
            return parent::beforeSave($insert);
        }

        /**
         * @inheritdoc
         * @param bool $insert
         * @param array $changedAttributes
         */
        public function afterSave($insert, $changedAttributes)
        {
            parent::afterSave($insert, $changedAttributes);

            if($insert) {
                $this->username = $this->generateUsername();
                $this->save(false);
            }
        }

        public function generateUsername()
        {
            if (!is_numeric($this->id)) {
                die('cant generate username since user id is empty');
            }

            return $this->first_name . ' ' . $this->last_name . ' #' . $this->id;
        }

        /**
         * Get validation errors from ff api
         * @param $response
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
