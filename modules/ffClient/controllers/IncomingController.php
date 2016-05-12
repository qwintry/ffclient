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
    use app\modules\ffClient\models\Incoming;
    use app\modules\ffClient\models\SpecialRequest;
    use yii\data\ArrayDataProvider;
    use yii\filters\AccessControl;
    use yii\helpers\Url;
    use yii\web\NotFoundHttpException;

    class IncomingController extends BaseController
    {

        /**
         * @var string
         */
        public $incomingModelClass = 'app\modules\ffClient\models\Incoming';
        /**
         * @var string
         */
        public $incomingFormClass = 'app\modules\ffClient\models\forms\IncomingForm';
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
         * @param \yii\base\Action $action
         *
         * @return bool
         * @throws \yii\web\BadRequestHttpException
         */
        public function beforeAction($action)
        {
            Url::remember();

            return parent::beforeAction($action);
        }

        /**
         * @return string
         * @throws \yii\web\HttpException
         */
        public function actionIndex()
        {
            $incomings = Incoming::findAll([
                'user_id' => \Yii::$app->user->ffId,
            ]);
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
            if($incoming->user_id != \Yii::$app->user->ffId) {
                throw new NotFoundHttpException("Incoming not found!");
            }

            $specialRequestsProvider = new ArrayDataProvider([
                'allModels' => $incoming->specRequests,
            ]);

            $declarationProvider = new ArrayDataProvider([
                'allModels' => $incoming->items,
            ]);

            return $this->render('view', [
                'model'                   => $incoming,
                'specialRequestsProvider' => $specialRequestsProvider,
                'declarationProvider'     => $declarationProvider,
            ]);
        }

    }