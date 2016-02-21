<?php

    namespace app\modules\ffClient\controllers;

    use app\models\User;
    use yii\data\ActiveDataProvider;
    use yii\filters\AccessControl;
    use yii\helpers\Url;
    use yii\web\NotFoundHttpException;

    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 22.01.2016
     * Time: 13:43
     *
     */
    class UserController extends BaseController
    {

        public function behaviors()
        {
            return [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'actions' => ['index', 'update', 'create', 'view', 'view-ex'],
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
        public function actionIndex()
        {
            $query = User::find();
            $provider = new ActiveDataProvider([
                'query' => $query,
            ]);

            return $this->render('index', [
                'provider' => $provider,
            ]);
        }

        /**
         * @return string
         */
        public function actionCreate()
        {
            $model = new User();

            //get post data
            if ($data = \Yii::$app->request->post('User')) {
                $route = $this->getApiRoute('user_create');
                //send data to ff api and check errors
                $response = $this->doRequest($route, $data);
                $model->setAttributes($data, false);
                $model->checkApiErrors($response);
                if (!$model->hasErrors()) {
                    $model->ff_id = $response->id;
                    $model->setPassword($data['password']);
                    $model->generateAuthKey();
                    $model->save(false);
                    $this->redirect(['view', 'id' => $model->id]);
                }
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        }

        /**
         * @param $id
         *
         * @return string
         * @throws \yii\web\NotFoundHttpException
         */
        public function actionUpdate($id)
        {
            /**
             * @var User $model
             */
            $model = User::findOne($id);
            if (null === $model) {
                throw new NotFoundHttpException("User not found!");
            }

            $model->scenario = \app\modules\ffClient\models\User::SCENARIO_UPDATE;

            //get post data
            if ($model->load(\Yii::$app->request->post())) {

                $route = $this->getApiRoute('user_update');
                $params = http_build_query([
                    'id' => $id,
                ]);
                $url = $route."?".$params;
                //send data to ff api and check errors
                $response = $this->doRequest($url, $model->getAttributes(), 'PATCH');
                $model->checkApiErrors($response);
                if (!$model->hasErrors()) {
                    $model->save(false);
                    $this->redirect(['/ffClient/user/index']);
                }
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        }

        /**
         * @param $id
         *
         * @return string
         * @throws \yii\web\HttpException
         */
        public function actionView($id)
        {
            $model = User::findOne($id);
            if (null === $model) {
                throw new NotFoundHttpException("User not found!");
            }

            return $this->render('view', [
                'model' => $model,
            ]);
        }

        /**
         * @param $id
         *
         * @return \yii\web\Response
         * @throws \yii\web\NotFoundHttpException
         */
        public function actionViewEx($id)
        {
            $user = User::findOne(['ff_id' => $id]);
            if (null == $user) {
                throw new NotFoundHttpException('User not found!');
            }

            return $this->redirect(Url::to(['view', 'id' => $user->id]));
        }
    }