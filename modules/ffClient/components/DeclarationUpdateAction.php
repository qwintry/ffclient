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
    use app\modules\ffClient\models\forms\ApiForm;
    use app\modules\ffClient\models\forms\DeclarationForm;
    use app\modules\ffClient\models\forms\ExpectedIncomingForm;
    use app\modules\ffClient\models\forms\IncomingForm;
    use yii\base\Action;
    use yii\base\Controller;
    use yii\helpers\ArrayHelper;
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
             * @var ApiModel $incomingModelClass
             * @var ApiForm $incomingFormClass
             *
             * @var BaseController $this->controller
             * @var ApiForm $model
             * @var ApiForm $incomingForm
             */
            $incomingModelClass = $this->controller->incomingModelClass;
            $incomingFormClass =  $this->controller->incomingFormClass;

            $incoming = $incomingModelClass::findOne(['id' => $id]);
            $incomingForm = $this->controller->getForm($incomingFormClass::className(), $incoming->id);
            $declaration = $incoming->declaration;
            $incomingForm->country = ArrayHelper::getValue($declaration, 'country');
            $incomingForm->declMethod = ArrayHelper::getValue($declaration, 'method');

            $models = [];
            if ($items = $incoming->items) {
                foreach ($items as $item) {
                    $model = $this->controller->getForm(DeclarationForm::className(), $item['id']);
                    $model->setAttributes((array)$item, false);
                    $models[] = $model;
                }
            }

            //saving data
            if (\Yii::$app->request->isPost) {
                $rc = new \ReflectionClass($incomingForm);
                $incomingFormClassShort = $rc->getShortName();

                $declarationFormData = \Yii::$app->request->post('DeclarationForm');
                $incomingFormData = \Yii::$app->request->post($incomingFormClassShort);
                $data = $incomingFormData;
                $data['items'] = $declarationFormData;
                $incoming::save($id, $data);

                return $this->controller->redirect(Url::to(['view', 'id' => $id]));
            }

            //add new item
            $models[] = $this->controller->getForm(DeclarationForm::className());

            //render view
            return $this->controller->render('@app/modules/ffClient/views/common/declaration-update', [
                'items' => $models,
                'model' => $incomingForm,
            ]);
        }

    }