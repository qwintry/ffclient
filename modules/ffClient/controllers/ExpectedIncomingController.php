<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 04.02.2016
     * Time: 13:50
     */

    namespace app\modules\ffClient\controllers;

    use app\modules\ffClient\components\DeclarationUpdateAction;
    use app\modules\ffClient\components\SpecialRequestCreateAction;
    use app\modules\ffClient\models\ExpectedIncoming;
    use app\modules\ffClient\models\forms\ExpectedIncomingForm;
    use app\modules\ffClient\models\forms\SpecialRequestForm;
    use app\modules\ffClient\models\SpecialRequest;
    use yii\data\ArrayDataProvider;
    use yii\filters\AccessControl;
    use yii\helpers\Url;

    class ExpectedIncomingController extends BaseController
    {
        /**
         * @var string
         */
        public $incomingModelClass = 'app\modules\ffClient\models\ExpectedIncoming';
        /**
         * @var string
         */
        public $incomingFormClass = 'app\modules\ffClient\models\forms\ExpectedIncomingForm';
        /**
         * @var string
         */
        public $relatedTypeIncoming;

        public function init()
        {
            parent::init();

            $this->relatedTypeIncoming = SpecialRequest::RELATED_TYPE_EXPECTED_INCOMING;
        }

        /**
         * @return array
         */
        public function actions()
        {
            return [
                'declaration-update'     => DeclarationUpdateAction::className(),
                'special-request-create' => SpecialRequestCreateAction::className(),
            ];
        }

        /**
         * @return array
         */
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
                                'special-request-create',
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
        public function actionIndex()
        {
            $expectedIncomings = ExpectedIncoming::findAll();
            $provider = new ArrayDataProvider([
                'allModels' => $expectedIncomings,
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
                'allModels' => $expectedIncoming->specRequests,
            ]);
            $declarationProvider = new ArrayDataProvider([
                'allModels' => $expectedIncoming->items,
            ]);

            return $this->render('view', [
                'model'                   => $expectedIncoming,
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
    }