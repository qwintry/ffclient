<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 04.02.2016
     * Time: 10:10
     */

    namespace app\modules\ffClient\controllers;

    use app\modules\ffClient\models\forms\PasswordResetRequestForm;
    use app\modules\ffClient\models\forms\ResetPasswordForm;
    use app\modules\ffClient\models\forms\SignupForm;
    use app\modules\ffClient\Module;
    use yii\base\InvalidParamException;
    use yii\helpers\ArrayHelper;
    use yii\web\BadRequestHttpException;
    use yii\web\Controller;

    class SiteController extends BaseController
    {

        /**
         * Signs user up.
         *
         * @return mixed
         */
        public function actionSignup()
        {
            $model = new SignupForm();
            if ($model->load(\Yii::$app->request->post())) {
                //try to create user in ff
                $route = $this->getApiRoute(Module::ROUTE_USER_CREATE);
                //send data to ff api and check errors
                $response = $this->doRequest($route, $model->getAttributes());
                $model->checkApiErrors($response);
                if (!$model->hasErrors()) {
                    $model->ff_id = ArrayHelper::getValue($response, 'id');
                    if ($user = $model->signup()) {
                        if (\Yii::$app->getUser()->login($user)) {
                            return $this->goHome();
                        }
                    }
                }
            }

            return $this->render('signup', [
                'model' => $model,
            ]);
        }

        /**
         * Requests password reset.
         *
         * @return mixed
         */
        public function actionRequestPasswordReset($email = null)
        {
            $model = new PasswordResetRequestForm();
            if ($email) {
                $model->email = $email;
            }
            if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
                if ($model->sendEmail()) {
                    \Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                    return $this->goHome();
                } else {
                    \Yii::$app->session->setFlash('error',
                        'Sorry, we are unable to reset password for email provided.');
                }
            }

            return $this->render('@app/modules/ffClient/views/site/requestPasswordResetToken', [
                'model' => $model,
            ]);
        }

        /**
         * Resets password.
         *
         * @param string $token
         *
         * @return mixed
         * @throws BadRequestHttpException
         */
        public function actionResetPassword($token)
        {
            try {
                $model = new ResetPasswordForm($token);
            } catch (InvalidParamException $e) {
                throw new BadRequestHttpException($e->getMessage());
            }
            if ($model->load(\Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
                \Yii::$app->session->setFlash('success', 'New password was saved.');

                return $this->goHome();
            }

            return $this->render('@app/modules/ffClient/views/site/resetPassword', [
                'model' => $model,
            ]);
        }


    }