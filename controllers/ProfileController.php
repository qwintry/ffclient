<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 21.06.2016
     * Time: 12:00
     */

    namespace app\controllers;

    use app\models\forms\profile\ActivationForm;
    use app\models\forms\profile\RegistrationForm;
    use yii\filters\AccessControl;
    use yii\web\Controller;

    class ProfileController extends Controller
    {

        public function behaviors()
        {
            return [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'actions' => [
                                'registration',
                            ],
                            'allow'   => true,
                            'roles'   => ['?'],
                        ],
                        [
                            'actions' => [
                                'activate',
                                'view',
                            ],
                            'allow'   => true,
                            'roles'   => ['@'],
                        ],
                    ],
                ],
            ];
        }


        /**
         * @return string
         */
        public function actionRegistration()
        {
            $model = new RegistrationForm();

            if ($model->load(\Yii::$app->request->post()) && $model->registerUser()) {
                return $this->redirect(['activate']);
            }

            return $this->render('registration', [
                'model' => $model,
            ]);
        }

        /**
         * @return string|\yii\web\Response
         */
        public function actionActivate()
        {
            if (\Yii::$app->user->ffId) {
                return $this->redirect(['view']);
            }

            $model = new ActivationForm();

            if ($model->load(\Yii::$app->request->post()) && $model->updateUser()) {
                return $this->redirect(['view']);
            }

            return $this->render('view', [
                'model' => $model,
            ]);
        }

        /**
         * @return string|\yii\web\Response
         */
        public function actionView()
        {
            if (!\Yii::$app->user->ffId) {
                return $this->redirect(['activate']);
            }

            return $this->render('view');
        }

    }