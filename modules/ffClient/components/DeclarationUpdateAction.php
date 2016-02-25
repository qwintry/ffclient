<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 25.02.2016
     * Time: 11:16
     */

    namespace app\modules\ffClient\components;

    use app\modules\ffClient\models\ApiModel;
    use app\modules\ffClient\models\forms\DeclarationForm;
    use yii\base\Action;
    use yii\base\Controller;
    use yii\helpers\Url;

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
             * @var ApiModel $model
             * @var Controller $this ->controller
             */
            $model = $this->controller->incomingModel;
            $incoming = $model::findOne(['id' => $id]);

            $models = [];
            foreach ($incoming->declaration as $item) {
                $model = $this->controller->getForm(DeclarationForm::className(), $item->id);
                $model->setAttributes((array)$item, false);
                $models[] = $model;
            }

            //saving data
            if ($data = \Yii::$app->request->post('DeclarationForm')) {
                $model::save($id, ['items' => $data]);

                return $this->controller->redirect(Url::to(['view', 'id' => $id]));
            }

            $models[] = $this->controller->getForm(DeclarationForm::className());

            //render view
            return $this->controller->render('@app/modules/ffClient/views/common/declaration-update', [
                'models' => $models,
            ]);
        }

    }