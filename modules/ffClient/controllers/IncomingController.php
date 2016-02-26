<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 05.02.2016
     * Time: 14:12
     */

    namespace app\modules\ffClient\controllers;

    use app\modules\ffClient\components\DeclarationUpdateAction;
    use app\modules\ffClient\components\SpecialRequestCreateAction;
    use app\modules\ffClient\models\forms\IncomingForm;
    use app\modules\ffClient\models\Incoming;
    use app\modules\ffClient\models\SpecialRequest;
    use yii\data\ArrayDataProvider;
    use yii\filters\AccessControl;
    use yii\helpers\Url;

    class IncomingController extends BaseController
    {

        /**
         * @var string
         */
        public $incomingModel = 'app\modules\ffClient\models\Incoming';
        /**
         * @var string
         */
        public $relatedTypeIncoming;

        public function init()
        {
            parent::init();

            $this->relatedTypeIncoming = SpecialRequest::RELATED_TYPE_INCOMING;
        }

        /**
         * @return array
         */
        public function actions()
        {
            return [
                'declaration-update' => DeclarationUpdateAction::className(),
                'special-request-create' => SpecialRequestCreateAction::className(),
            ];
        }

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
         * @throws \yii\web\HttpException
         */
        public function actionIndex()
        {
            $incomings = Incoming::findAll();
            $provider = new ArrayDataProvider([
                'models'     => $incomings,
                'totalCount' => count($incomings),
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
            $incoming = Incoming::findOne(['id' => $id]);

            $specialRequestsProvider = new ArrayDataProvider([
                'allModels' => $incoming->specRequests,
            ]);

            $declarationProvider = new ArrayDataProvider([
                'allModels' => $incoming->declaration,
            ]);

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
//        public function actionUpdate($id)
//        {
//            $model = $this->getForm(IncomingForm::className(), $id);
//
//            //saving data
//            if ($data = \Yii::$app->request->post('IncomingForm')) {
//                if ($incoming = Incoming::save($id, $data)) {
//                    $model->checkApiErrors($incoming);
//                    if (!$model->hasErrors()) {
//                        return $this->redirect(Url::to(['view', 'id' => $model->id]));
//                    }
//                }
//            }
//
//            //render update form
//            $incoming = Incoming::findOne(['id' => $id]);
//            $model->setAttributes($incoming->getAttributes(), false);
//
//            return $this->render('update', [
//                'model' => $model,
//            ]);
//        }

    }