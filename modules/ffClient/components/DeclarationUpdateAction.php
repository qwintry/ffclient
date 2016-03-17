<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 25.02.2016
     * Time: 11:16
     */

    namespace app\modules\ffClient\components;

    use app\modules\ffClient\controllers\BaseController;
    use app\modules\ffClient\models\ApiModel;
    use app\modules\ffClient\models\forms\DeclarationForm;
    use app\modules\ffClient\models\Item;
    use yii\base\Action;
    use yii\web\NotFoundHttpException;

    class DeclarationUpdateAction extends Action
    {
        /**
         * @param $id
         *
         * @return string|\yii\web\Response
         * @throws \yii\web\NotFoundHttpException
         */
        public function run($id)
        {
            /**
             * @var ApiModel $incomingModelClass
             */
            $incomingModelClass = $this->controller->incomingModelClass;
            /**
             * @var BaseController $controller
             */
            $controller = $this->controller;

            $incoming = $incomingModelClass::findOne(['id' => $id]);
            if ($incoming == null) {
                throw new NotFoundHttpException();
            }

            /**
             * @var DeclarationForm $model
             */
            $model = $controller->getForm(DeclarationForm::className());
            if ($incoming->declaration) {
                $model->setAttributes($incoming->declaration, false);
            }

            if ($data = \Yii::$app->request->post()) {
                $incomingData = $data['DeclarationForm'];
                $incomingData['items'] = $data['Item'];

                $response = $incomingModelClass::save($id, $incomingData);
                $model->checkApiErrors($response);
                if (!$model->hasErrors()) {
                    return $this->controller->refresh();
                }

                $model->setAttributes($data['DeclarationForm'], false);
                $model->setItems($data['Item']);
            } else {
                $model->setItems($incoming->items);
                $model->items[] = new Item();
            }

            //render view
            return $this->controller->render('@app/modules/ffClient/views/common/declaration-update', [
                'model' => $model,
            ]);
        }

    }