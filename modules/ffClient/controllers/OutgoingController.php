<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 11.02.2016
     * Time: 10:40
     */

    namespace app\modules\ffClient\controllers;

    use app\modules\ffClient\models\File;
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
                                'pay',
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
            $outgoings = Outgoing::findAll([
                'user_id' => \Yii::$app->user->ffId,
            ]);

            $provider = new ArrayDataProvider([
                'allModels' => $outgoings,
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
            if ($outgoing->user_id != \Yii::$app->user->ffId) {
                throw new NotFoundHttpException("Outgoing not found!");
            }

            $declarationProvider = new ArrayDataProvider([
                'allModels' => $outgoing->items,
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
            $user_id = \Yii::$app->user->ffId;

            $incomings = Incoming::findAll(['user_id' => $user_id]);
            $incomings = ArrayHelper::map($incomings, 'id', function ($item) {
                return "#".$item['id']." ".$item['tracking'];
            });

            $model = $this->getForm(OutgoingForm::className());
            $model->user_id = $user_id;

            if ($data = \Yii::$app->request->post('OutgoingForm')) {
                if(ArrayHelper::getValue($data, 'user_id') === null) {
                    $data['user_id'] = $user_id;
                }
                /**
                 * @var File[] $files
                 */
                $files = File::getInstances($model, 'passportFiles');
                foreach ($files as $file) {
                    $file->upload();
                    $data['address']['passportFiles'][] = [
                        'base64Data'      => $file->getBase64Encoded(),
                        'base64Extension' => $file->getExtension(),
                    ];
                    $file->delete();
                }

                if ($outgoing = Outgoing::create($data)) {
                    $model->checkApiErrors($outgoing);
                    if (!$model->hasErrors()) {
                        return $this->redirect(Url::to(['index']));
                    }
                }
                $model->setAttributes($data, false);
                $model->address = $data['address'];
            }

            return $this->render('create', [
                'model'     => $model,
                'incomings' => $incomings,
            ]);
        }

        /**
         * @param $id
         *
         * @return \yii\web\Response
         * @throws \yii\base\Exception
         */
        public function actionPay($id)
        {
            $outgoing = Outgoing::findOne([
                'id'      => $id,
                'user_id' => \Yii::$app->user->ffId,
            ]);
            $outgoing->pay();

            return $this->redirect(Url::to(['view', 'id' => $id]));
        }
    }