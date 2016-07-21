<?php
    namespace app\widgets;

    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 21.07.2016
     * Time: 14:01
     */
    class Calculator extends \yii\base\Widget
    {

        /**
         * @return string
         */
        public function run()
        {
            $model = new \app\models\Calculator();

            return $this->render('calculator', [
                'model' => $model,
            ]);
        }

        /**
         * @return array
         */
        public static function getMeasurementSystems()
        {
            return [
                'kg' => 'кг',
                'lb' => 'фунтов',
            ];
        }


        public static function getCountries()
        {
            return \Yii::$app->getModule('ffClient')->reference->countriesList();
        }


        public static function getCities()
        {
            return \Yii::$app->getModule('ffClient')->reference->citiesList();
        }

    }