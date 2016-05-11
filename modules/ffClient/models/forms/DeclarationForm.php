<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 10.02.2016
     * Time: 12:14
     */

    namespace app\modules\ffClient\models\forms;

    use app\modules\ffClient\models\Item;
    use yii\helpers\ArrayHelper;
    use yii\helpers\VarDumper;

    /**
     * Class DeclarationForm
     * @package app\modules\ffClient\models\forms
     */
    class DeclarationForm extends ApiForm
    {
        /**
         * @var Item[]
         */
        public $items = [];

        /**
         * @param array $items
         */
        public function setItems(array $items)
        {
            foreach ($items as $k => $_item) {
                $item = new Item();
                $item->setAttributes($_item, false);

                if (!$item->isEmpty()) {
                    $this->items[$k] = $item;
                }
            }

            $errors = $this->getErrors();
            if ($itemsErrors = ArrayHelper::getValue($errors, 'items')) {
                $itemsErrors = $itemsErrors[0];

                foreach ($itemsErrors as $i => $itemsError) {
                    foreach ($itemsError as $field => $msg) {
                        if (ArrayHelper::getValue($this->items, $i)) {
                            $this->items[$i]->addError($field, $msg[0]);
                        }
                    }
                }
            }
        }

        public function isEmpty()
        {
            foreach ($this->getAttributes() as $attribute => $value) {
                if ((bool)$value) {
                    return false;
                }
            }

            return true;
        }
    }