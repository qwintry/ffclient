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
         * @return string
         */
        public function actionIndex()
        {
            $filter = [
                'expand' => 'specRequests, declaration',
            ];
            $url = $this->getApiRoute(Module::ROUTE_EXPECTED_INCOMING_INDEX)."?".http_build_query($filter);
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
            $filter = [
                'id'     => $id,
                'expand' => 'specRequests, declaration',
            ];
            $url = $this->getApiRoute(Module::ROUTE_EXPECTED_INCOMING_VIEW)."?".http_build_query($filter);
            if ($response = $this->doRequest($url)) {

                return $this->render('view', [
                    'model' => $response,
                ]);
            }

            throw new NotFoundHttpException();
        }

        public function actionUpdate($id)
        {
            $filter = [
                'id'     => $id,
                'expand' => 'specRequests, declaration',
            ];
            $url = $this->getApiRoute(Module::ROUTE_EXPECTED_INCOMING_VIEW)."?".http_build_query($filter);
            if ($response = $this->doRequest($url)) {
                $attrs = [];
                foreach (Module::$expectedIncomingAttrs as $attr) {
                    if (ArrayHelper::getValue($response, $attr, false) !== false) {
                        $value = ArrayHelper::getValue($response, $attr);
                        $attrs[$attr] = $value;
                    }
                }
                $model = new ExpectedIncomingForm($attrs);

                return $this->render('update', [
                    'model' => $model,
                ]);
            }

            throw new NotFoundHttpException();
        }
    }