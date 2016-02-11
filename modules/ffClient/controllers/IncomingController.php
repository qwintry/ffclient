<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 05.02.2016
     * Time: 14:12
     */

    namespace app\modules\ffClient\controllers;

    use app\modules\ffClient\models\forms\DeclarationForm;
    use app\modules\ffClient\models\forms\IncomingForm;
    use app\modules\ffClient\models\forms\SpecialRequestForm;
    use app\modules\ffClient\models\Incoming;
    use app\modules\ffClient\models\SpecialRequest;
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
                'models'     => $incoming->specRequests,
                'totalCount' => count($incoming->specRequests),
            ]);

            $declarationProvider = new ArrayDataProvider([
                'models'     => $incoming->declaration,
                'totalCount' => count($incoming->declaration),
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
        public function actionUpdate($id)
        {
            $model = $this->getForm(IncomingForm::className(), $id);

            //saving data
            if ($data = \Yii::$app->request->post('IncomingForm')) {
                if ($incoming = Incoming::save($id, $data)) {
                    $model->checkApiErrors($incoming);
                    if (!$model->hasErrors()) {
                        return $this->redirect(Url::to(['view', 'id' => $model->id]));
                    }
                }
            }

            //render update form
            $incoming = Incoming::findOne(['id' => $id]);
            $model->setAttributes((array)$incoming, false);

            return $this->render('update', [
                'model' => $model,
            ]);
        }

        /**
         * @param $id
         *
         * @return string|\yii\web\Response
         * @throws \yii\web\NotFoundHttpException
         */
        public function actionDeclarationUpdate($id)
        {
            $incoming = Incoming::findOne(['id' => $id]);

            $models = [];
            foreach ($incoming->declaration as $item) {
                $model = $this->getForm(DeclarationForm::className(), $item->id);
                $model->setAttributes((array)$item, false);
                $models[] = $model;
            }

            //saving data
            if ($data = \Yii::$app->request->post('DeclarationForm')) {
                Incoming::save($id, ['items' => $data]);

                return $this->redirect(Url::to(['view', 'id' => $id]));
            }

            $models[] = $this->getForm(DeclarationForm::className());

            //render view
            return $this->render('declaration-update', [
                'models' => $models,
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
                $data['relatedType'] = 'incoming';
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