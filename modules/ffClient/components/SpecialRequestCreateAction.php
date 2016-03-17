<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 25.02.2016
     * Time: 11:37
     */

    namespace app\modules\ffClient\components;

    use app\modules\ffClient\models\forms\ApiForm;
    use app\modules\ffClient\models\forms\SpecialRequestForm;
    use app\modules\ffClient\models\SpecialRequest;
    use yii\base\Action;
    use yii\base\Controller;
    use yii\helpers\Url;

    class SpecialRequestCreateAction extends Action
    {
        /**
         * @param $id
         *
         * @return string|\yii\web\Response
         */
        public function run($id)
        {
            /**
             * @var Controller $this ->controller
             * @var ApiForm $model
             */
            $model = $this->controller->getForm(SpecialRequestForm::className());

            if ($data = \Yii::$app->request->post('SpecialRequestForm')) {
                $data['relatedId'] = $id;
                $data['relatedType'] = $this->controller->relatedTypeIncoming;
                $specialRequest = SpecialRequest::create($data);
                $model->checkApiErrors($specialRequest);
                if (!$model->hasErrors()) {
                    return $this->controller->redirect(Url::to(['view', 'id' => $id]));
                }
                $model->setAttributes($data, false);
            }

            return $this->controller->render('@app/modules/ffClient/views/common/special-request-create', [
                'model' => $model,
            ]);
        }

    }