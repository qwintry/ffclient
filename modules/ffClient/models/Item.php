<?php

    namespace app\modules\ffClient\models;

    use Yii;
    use yii\base\Model;

    /**
     * This is the model class for table "item".
     *
     * @property int $id
     * @property string $descr
     * @property string $descrLocal
     * @property string $url
     * @property double $totalValue
     * @property double $totalWeight
     * @property integer $quantity
     */
    class Item extends Model
    {
        public $id;
        public $descr;
        public $descrLocal;
        public $totalValue;
        public $totalWeight;
        public $quantity;

        /**
         * @return bool
         */
        public function isEmpty()
        {
            foreach ($this->getAttributes() as $attribute => $value) {
                if((bool)$value) {
                    return false;
                }
            }

            return true;
        }
    }
