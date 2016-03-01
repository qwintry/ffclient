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
            $outgoings = Outgoing::findAll();

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
            $declarationProvider = new ArrayDataProvider([
                'allModels' => $outgoing->declaration,
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
            if ($incomings = Incoming::findAll()) {
                $incomings = ArrayHelper::map($incomings, 'id', function ($item) {
                    return "#".$item['id']." ".$item['tracking'];
                });
            } else {
                $incomings = [];
            }

            if ($data = \Yii::$app->request->post('OutgoingForm')) {
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

                $data['user_id'] = \Yii::$app->user->getIdentity()->ff_id;

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
            $outgoing = Outgoing::findOne(['id' => $id]);
            $outgoing->pay();

            return $this->redirect(Url::to(['view', 'id' => $id]));
        }
    }