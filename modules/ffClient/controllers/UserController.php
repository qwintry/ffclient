<?php

    namespace app\modules\ffClient\controllers;

    use app\models\User;
    use yii\data\ActiveDataProvider;
    use yii\data\ArrayDataProvider;
    use yii\filters\AccessControl;
    use yii\helpers\ArrayHelper;
    use yii\helpers\VarDumper;
    use yii\web\HttpException;
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
                            'actions' => ['index', 'update', 'create', 'view'],
                            'allow'   => true,
                            'roles'   => ['@'],
                        ],
                    ],
                ],
            ];
        }

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
            if ($model->load(\Yii::$app->request->post())) {
                $route = $this->getApiRoute('user_create');
                //send data to ff api and check errors
                $response = $this->doRequest($route, $model->getAttributes());
                $model->checkApiErrors($response);
                if (!$model->hasErrors()) {
                    $this->redirect(['/ffClient/user/index']);
                }
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        }

        public function actionUpdate($id)
        {
            /**
             * @var User $model
             */
            $model = User::findOne($id);
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

        public function actionView($id)
        {
            $model = User::findOne($id);

            return $this->render('view', [
                'model' => $model,
            ]);
        }
    }