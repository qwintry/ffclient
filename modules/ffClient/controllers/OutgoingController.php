<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 11.02.2016
     * Time: 10:40
     */

    namespace app\modules\ffClient\controllers;

    use app\modules\ffClient\models\forms\OutgoingForm;
    use app\modules\ffClient\models\Incoming;
    use app\modules\ffClient\models\Outgoing;
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
         * @return string
         */
        public function actionIndex()
        {
            $outgoings = Outgoing::findAll();

            $provider = new ArrayDataProvider([
                'models'     => $outgoings,
                'totalCount' => count($outgoings),
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
            $outgoing = Outgoing::findOne(['id' => $id]);

            $declarationProvider = new ArrayDataProvider([
                'models'     => $outgoing->declaration,
                'totalCount' => count($outgoing->declaration),
            ]);

            return $this->render('view', [
                'model'               => $outgoing,
                'declarationProvider' => $declarationProvider,
            ]);
        }

        /**
         * @return string|\yii\web\Response
         */
        public function actionCreate()
        {
            $model = $this->getForm(OutgoingForm::className());
            if($incomings = Incoming::findAll()) {
                $incomings = ArrayHelper::map($incomings, 'id', 'tracking');
            } else {
                $incomings = [];
            }


            if ($data = \Yii::$app->request->post('OutgoingForm')) {
                if ($outgoing = Outgoing::create($data)) {
                    $model->checkApiErrors($outgoing);
                    if (!$model->hasErrors()) {
                        return $this->redirect(Url::to(['index']));
                    }
                }
                $model->setAttributes($data, false);
            }

            return $this->render('create', [
                'model' => $model,
                'incomings' => $incomings,
            ]);
        }
    }