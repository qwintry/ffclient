<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 11.02.2016
     * Time: 10:40
     */

    namespace app\modules\ffClient\controllers;

    use app\modules\ffClient\models\forms\DeclarationForm;
    use app\modules\ffClient\models\forms\OutgoingForm;
    use app\modules\ffClient\Module;
    use yii\data\ArrayDataProvider;
    use yii\filters\AccessControl;
    use yii\helpers\ArrayHelper;
    use yii\helpers\Url;
    use yii\helpers\VarDumper;
    use yii\web\NotFoundHttpException;

    class OutgoingController extends BaseController
    {

        public function behaviors()
        {
            return [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'actions' => [
                                'index',
                                'update',
                                'create',
                                'view',
                                'declaration-update',
                            ],
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
                'expand' => 'declaration, storeInvoice',
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
            $url = $this->getApiRoute(Module::ROUTE_OUTGOING_INDEX, $filter);
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
         */
        public function actionView($id)
        {
            $filter = $this->getFilter(['id' => $id]);
            $url = $this->getApiRoute(Module::ROUTE_OUTGOING_VIEW, $filter);
            $response = $this->doRequest($url);

            $declarationProvider = new ArrayDataProvider([
                'models' => $response->declaration,
                'totalCount' => count($response->declaration),
            ]);

            return $this->render('view', [
                'model' => $response,
                'declarationProvider' => $declarationProvider,
            ]);
        }

        /**
         * @return string|\yii\web\Response
         */
        public function actionCreate()
        {
            $model = $this->getModel(OutgoingForm::className());

            if ($data = \Yii::$app->request->post('OutgoingForm')) {
                $response = $this->doRequest(Module::ROUTE_OUTGOING_CREATE, $data);
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