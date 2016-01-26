<?php

    namespace app\modules\ffClient\controllers;

    use app\modules\ffClient\models\UserForm;
    use yii\data\ArrayDataProvider;
    use yii\helpers\ArrayHelper;
    use yii\helpers\VarDumper;
    use yii\web\HttpException;
    use yii\web\NotFoundHttpException;

    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 22.01.2016
     * Time: 13:43
     */
    class UserController extends BaseController
    {

        public function actionIndex()
        {
            $filters = []; //all filters are optional
            $route = $this->getApiRoute('user_index').'?'.http_build_query($filters);
            $response = $this->doRequest($route);
            $provider = new ArrayDataProvider([
                'allModels' => $response,
            ]);

            VarDumper::dump($response, 10, true);

            return $this->render('index', [
                'provider' => $provider,
            ]);
        }

        /**
         * @return string
         */
        public function actionCreate()
        {
            $model = new UserForm();

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
            $model = $this->loadUser($id);

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
                    $this->redirect(['/ffClient/user/index']);
                }
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        }

        public function actionView($id)
        {
            $model = $this->loadUser($id);

            return $this->render('view', [
                'model' => $model,
            ]);
        }

        /**
         * @param $id
         * @param \app\modules\ffClient\models\UserForm|null $model
         *
         * @throws \yii\web\NotFoundHttpException
         */
        protected function loadUser($id)
        {
            //load data from api
            $route = $this->getApiRoute('user_index').'?id='.$id;
            $response = $this->doRequest($route);
            if ($user = ArrayHelper::getValue($response, 0)) {
                //set attribute to model
                $modelAttributes = [];
                foreach ($user as $attribute => $value) {
                    $modelAttributes[$attribute] = $value;
                }
                $model = new UserForm($modelAttributes);

                return $model;
            } else {
                throw new NotFoundHttpException();
            }
        }
    }