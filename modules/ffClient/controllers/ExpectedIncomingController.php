<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 04.02.2016
     * Time: 13:50
     */

    namespace app\modules\ffClient\controllers;

    use app\modules\ffClient\models\forms\ExpectedIncomingForm;
    use app\modules\ffClient\Module;
    use yii\data\ArrayDataProvider;
    use yii\filters\AccessControl;
    use yii\helpers\ArrayHelper;
    use yii\helpers\Url;
    use yii\helpers\VarDumper;
    use yii\web\NotFoundHttpException;

    class ExpectedIncomingController extends BaseController
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

        /**
         * @param array $addFilter
         *
         * @return array
         */
        public function getFilter(array $addFilter = [])
        {
            $defaultFilter = [
                'expand' => 'specRequests, declaration',
            ];

            if ($addFilter) {
                return ArrayHelper::merge($defaultFilter, $addFilter);
            }

            return $defaultFilter;
        }

        /**
         * @return string
         */
        public function actionIndex()
        {
            $filter = $this->getFilter();
            $url = $this->getApiRoute(Module::ROUTE_EXPECTED_INCOMING_INDEX, $filter);
            $response = $this->doRequest($url);

            $provider = new ArrayDataProvider([
                'models'     => $response,
                'totalCount' => count($response),
            ]);

            return $this->render('index', [
                'provider' => $provider,
            ]);
        }

        /**
         * @param $id
         *
         * @return string
         * @throws \yii\web\NotFoundHttpException
         */
        public function actionView($id)
        {
            $filter = $this->getFilter(['id' => $id]);
            $url = $this->getApiRoute(Module::ROUTE_EXPECTED_INCOMING_VIEW, $filter);
            if ($response = $this->doRequest($url)) {

                return $this->render('view', [
                    'model' => $response,
                ]);
            }

            throw new NotFoundHttpException();
        }

        /**
         * @param $id
         *
         * @return string
         * @throws \yii\web\NotFoundHttpException
         */
        public function actionUpdate($id)
        {
            $model = $this->getModel(ExpectedIncomingForm::className(), $id);

            //saving data
            if ($data = \Yii::$app->request->post('IncomingForm')) {
                $url = $this->getApiRoute(Module::ROUTE_EXPECTED_INCOMING_VIEW, ['id' => $id]);
                if ($response = $this->doRequest($url, $data, 'PATCH')) {
                    $model->checkApiErrors($response);
                    if (!$model->hasErrors()) {
                        return $this->redirect(Url::to(['view', 'id' => $model->id]));
                    }
                }
            }

            //render update form
            $filter = $this->getFilter(['id' => $id]);
            $url = $this->getApiRoute(Module::ROUTE_EXPECTED_INCOMING_VIEW, $filter);

            if ($response = $this->doRequest($url)) {
                $model->setAttributes((array)$response, false);

                return $this->render('update', [
                    'model' => $model,
                ]);
            }

            throw new NotFoundHttpException();
        }

        public function actionCreate()
        {
            $model = $this->getModel(ExpectedIncomingForm::className());

            if ($data = \Yii::$app->request->post('ExpectedIncomingForm')) {
                $response = $this->doRequest(Module::ROUTE_EXPECTED_INCOMING_CREATE, $data);
                $model->setAttributes($data, false);
                $model->checkApiErrors($response);
                if (!$model->hasErrors()) {
                    return $this->redirect(Url::to(['index']));
                }
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }