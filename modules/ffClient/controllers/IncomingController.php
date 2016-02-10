<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 05.02.2016
     * Time: 14:12
     */

    namespace app\modules\ffClient\controllers;

    use app\modules\ffClient\models\forms\IncomingForm;
    use app\modules\ffClient\Module;
    use yii\data\ArrayDataProvider;
    use yii\filters\AccessControl;
    use yii\helpers\ArrayHelper;
    use yii\helpers\Url;
    use yii\helpers\VarDumper;
    use yii\web\NotFoundHttpException;

    class IncomingController extends BaseController
    {

        public function behaviors()
        {
            return [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'actions' => ['index', 'update', 'create', 'view', 'declaration-update'],
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
                'expand' => 'specRequests,packageThumbnails,declaration',
            ];

            if ($addFilter) {
                return ArrayHelper::merge($defaultFilter, $addFilter);
            }

            return $defaultFilter;
        }

        /**
         * @return string
         * @throws \yii\web\HttpException
         */
        public function actionIndex()
        {
            $filter = $this->getFilter();
            $url = $this->getApiRoute(Module::ROUTE_INCOMING_INDEX)."?".http_build_query($filter);
            $response = $this->doRequest($url);
            VarDumper::dump($response, 10, true);
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
         * @throws \yii\web\HttpException
         */
        public function actionView($id)
        {
            $filter = $this->getFilter(['id' => $id]);
            $url = $this->getApiRoute(Module::ROUTE_INCOMING_VIEW)."?".http_build_query($filter);
            $incoming = $this->doRequest($url);

            $specialRequestsProvider = false;
            if ($incoming->specRequests) {
                $specialRequestsProvider = new ArrayDataProvider([
                    'models'     => $incoming->specRequests,
                    'totalCount' => count($incoming->specRequests),
                ]);
            }

            $declarationProvider = false;
            if ($incoming->declaration) {
                $declarationProvider = new ArrayDataProvider([
                    'models'     => $incoming->declaration,
                    'totalCount' => count($incoming->declaration),
                ]);
            }

            return $this->render('view', [
                'model'                   => $incoming,
                'specialRequestsProvider' => $specialRequestsProvider,
                'declarationProvider'     => $declarationProvider,
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
            $model = $this->getModel(IncomingForm::className(), $id);

            //saving data
            if ($data = \Yii::$app->request->post('IncomingForm')) {
                $url = $this->getApiRoute(Module::ROUTE_INCOMING_UPDATE)."?id=$id";
                if ($response = $this->doRequest($url, $data, 'PATCH')) {
                    $model->checkApiErrors($response);
                    if (!$model->hasErrors()) {
                        return $this->redirect(Url::to(['view', 'id' => $model->id]));
                    }
                }
            }

            //render update form
            $filter = $this->getFilter(['id' => $id]);
            $url = $this->getApiRoute(Module::ROUTE_INCOMING_VIEW)."?".http_build_query($filter);

            if ($response = $this->doRequest($url)) {
                $model->setAttributes((array)$response, false);
                return $this->render('update', [
                    'model' => $model,
                ]);
            }

            throw new NotFoundHttpException();
        }

        public function actionDeclarationUpdate($id)
        {
        }
    }