<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 04.02.2016
     * Time: 13:50
     */

    namespace app\modules\ffClient\controllers;

    use app\modules\ffClient\models\ExpectedIncoming;
    use app\modules\ffClient\models\forms\ExpectedIncomingForm;
    use app\modules\ffClient\models\forms\SpecialRequestForm;
    use app\modules\ffClient\models\SpecialRequest;
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
                            'actions' => ['index', 'update', 'create', 'view', 'special-request-create'],
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
            $expectedIncomings = ExpectedIncoming::findAll();
            $provider = new ArrayDataProvider([
                'allModels'     => $expectedIncomings,
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
            $expectedIncoming = ExpectedIncoming::findOne(['id' => $id]);
            $specialRequestsProvider = new ArrayDataProvider([
                'allModels'     => $expectedIncoming->specRequests,
            ]);

            return $this->render('view', [
                'model' => $expectedIncoming,
                'specialRequestsProvider' => $specialRequestsProvider,
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
            $model = $this->getForm(ExpectedIncomingForm::className(), $id);

            //saving data
            if ($data = \Yii::$app->request->post('ExpectedIncomingForm')) {
                $expectedIncoming = ExpectedIncoming::save($id, $data);
                $model->checkApiErrors($expectedIncoming);
                if (!$model->hasErrors()) {
                    return $this->redirect(Url::to(['view', 'id' => $model->id]));
                }
            }

            //render update form
            $expectedIncoming = ExpectedIncoming::findOne(['id' => $id]);
            $model->setAttributes($expectedIncoming->getAttributes(), false);

            return $this->render('update', [
                'model' => $model,
            ]);
        }

        /**
         * @return string|\yii\web\Response
         */
        public function actionCreate()
        {
            $model = $this->getForm(ExpectedIncomingForm::className());

            if ($data = \Yii::$app->request->post('ExpectedIncomingForm')) {
                if ($expectedIncoming = ExpectedIncoming::create($data)) {
                    $model->checkApiErrors($expectedIncoming);
                    if (!$model->hasErrors()) {
                        return $this->redirect(Url::to(['index']));
                    }
                }
                $model->setAttributes($data, false);
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        }

        /**
         * @param $id
         *
         * @return string|\yii\web\Response
         */
        public function actionSpecialRequestCreate($id)
        {
            $model = $this->getForm(SpecialRequestForm::className());

            if ($data = \Yii::$app->request->post('SpecialRequestForm')) {
                $data['relatedId'] = $id;
                $data['relatedType'] = SpecialRequest::RELATED_TYPE_EXPECTED_INCOMING;
                $specialRequest = SpecialRequest::create($data);
                $model->checkApiErrors($specialRequest);
                if (!$model->hasErrors()) {
                    return $this->redirect(Url::to(['view', 'id' => $id]));
                }
                $model->setAttributes($data, false);
            }

            return $this->render('special-request', [
                'model' => $model,
            ]);
        }
    }