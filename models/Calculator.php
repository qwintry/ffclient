<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 21.07.2016
     * Time: 14:08
     */

    namespace app\models;

    use yii\base\Model;

    /**
     * Class Calculator
     * @package app\models
     */
    class Calculator extends Model
    {
        /**
         * @var int
         */
        public $weight;
        /**
         * @var string
         */
        public $weightMeasurementSystem;
        /**
         * @var string
         */
        public $country;
        /**
         * @var string
         */
        public $city;

        /**
         * @return array
         */
        public function attributeLabels()
        {
            return [
                'weight' => \Yii::t('app', 'Weight'),
            ];
        }

    }