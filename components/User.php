<?php

    namespace app\components;

    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 11.05.2016
     * Time: 10:52
     *
     *
     */
    class User extends \yii\web\User
    {

        /**
         * Returns a value that uniquely represents the user.
         * @return string|integer the unique identifier for the user. If null, it means the user is a guest.
         * @see getIdentity()
         */
        public function getFfId()
        {
            /**
             * @var \app\models\User $identity
             */
            $identity = $this->getIdentity();

            return $identity !== null ? $identity->ff_id : null;
        }

    }