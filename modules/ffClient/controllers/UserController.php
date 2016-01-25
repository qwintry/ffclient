<?php

    namespace app\modules\ffClient\controllers;

    use app\modules\ffClient\models\UserForm;
    use yii\data\ArrayDataProvider;
    use yii\helpers\VarDumper;

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
            $route = '/api/user/index?'.http_build_query($filters);

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
            $attributes = $this->getUserAttributes();
            $model = new UserForm($attributes);

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
                'model'      => $model,
                'attributes' => $attributes,
            ]);
        }

        public function actionUpdate($id)
        {
            $attributes = $this->getUserAttributes();
            $model = new UserForm($attributes);

            //load data from api
            $filters = [
                'id' => $id,
            ];
            $route = '/api/user/index?'.http_build_query($filters);
            $response = $this->doRequest($route);
            VarDumper::dump($response, 10, true);
            exit;

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
                'model'      => $model,
                'attributes' => $attributes,
            ]);
        }

    }