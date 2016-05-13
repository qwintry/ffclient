<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 04.02.2016
     * Time: 13:50
     */

    namespace app\modules\ffClient\controllers;

    use app\modules\ffClient\models\ExpectedIncoming;
    use app\modules\ffClient\models\File;
    use app\modules\ffClient\models\forms\ApiForm;
    use app\modules\ffClient\models\forms\SpecialRequestForm;
    use app\modules\ffClient\models\SpecialRequest;
    use yii\filters\AccessControl;
    use yii\helpers\Url;
    use yii\helpers\VarDumper;
    use yii\web\NotFoundHttpException;

    class SpecialRequestController extends BaseController
    {
        /**
         * @var string
         */
        public $requestModelClass = 'app\modules\ffClient\models\SpecialRequest';
        /**
         * @var string
         */
        public $requestFormClass = 'app\modules\ffClient\models\forms\SpecialRequestForm';

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
                                'update',
                                'create',
                                'view',
                                'delete',
                            ],
                            'allow'   => true,
                            'roles'   => ['@'],
                        ],
                    ],
                ],
            ];
        }

        /**
         * @param $id
         *
         * @return string
         * @throws \yii\web\NotFoundHttpException
         */
        public function actionView($id)
        {
            $specialRequest = SpecialRequest::findOne(['id' => $id]);

            return $this->render('view', [
                'model' => $specialRequest,
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
            $model = $this->getForm(SpecialRequestForm::className(), $id);

            //saving data
            if ($data = \Yii::$app->request->post('SpecialRequestForm')) {
                $data['customerFiles'] = $this->_setFiles($model);
                $specialRequest = SpecialRequest::save($id, $data);
                $model->checkApiErrors($specialRequest);
                if (!$model->hasErrors()) {
                    return $this->redirect(Url::to(['view', 'id' => $model->id]));
                }
            }

            //render update form
            $specialRequest = SpecialRequest::findOne(['id' => $id]);
            $model->setAttributes($specialRequest->getAttributes(), false);
            if($specialRequest->authorId != \Yii::$app->user->ffId) {
                throw new NotFoundHttpException("Special request incoming not found!");
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        }

        /**
         * @return string|\yii\web\Response
         */
        public function actionCreate($relatedType, $id)
        {
            if($relatedType == 'expected_incoming') {
                $expIncoming = ExpectedIncoming::findOne($id);
                if($expIncoming && $expIncoming['received']) {
                    return $this->redirect(['relatedType' => 'incoming', 'id' => $expIncoming['incoming']]);
                }
            }

            /**
             * @var ApiForm $model
             */
            $model = $this->getForm(SpecialRequestForm::className());

            if ($data = \Yii::$app->request->post('SpecialRequestForm')) {
                $data['relatedId'] = $id;
                $data['relatedType'] = $relatedType;
                $data['authorId'] = \Yii::$app->user->ffId;
                $data['customerFiles'] = $this->_setFiles($model);

                $specialRequest = SpecialRequest::create($data);
                $model->checkApiErrors($specialRequest);

                if (!$model->hasErrors()) {
                    return $this->redirect(Url::to(['view', 'id' => $specialRequest['id']]));
                }
                $model->setAttributes($data, false);
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        }

        private function _setFiles($model)
        {
            /**
             * @var File[] $files
             */
            $files = File::getInstances($model, 'customerFiles');
            $filesEncoded = [];
            foreach ($files as $file) {
                $file->upload();
                $filesEncoded[] = [
                    'base64Data'      => $file->getBase64Encoded(),
                    'base64Extension' => $file->getExtension(),
                ];
                $file->delete();
            }

            return $filesEncoded;
        }

        /**
         * @param $id
         *
         * @return string
         * @throws \yii\web\NotFoundHttpException
         */
        public function actionDelete($id)
        {
            $model = $this->getForm(SpecialRequestForm::className(), $id);

            $data['status'] = SpecialRequest::STATUS_CANCELED;

            $specialRequest = SpecialRequest::save($id, $data);
            $model->checkApiErrors($specialRequest);

            return $this->redirect(Url::previous());
        }
    }