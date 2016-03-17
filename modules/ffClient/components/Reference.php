<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 29.02.2016
     * Time: 12:34
     */

    namespace app\modules\ffClient\components;

    use app\modules\ffClient\Module;
    use yii\base\Component;

    class Reference extends Component
    {
        const TYPE_DIMENTIONS = 'dimensions';
        const TYPE_PHOTO = 'photo';
        const TYPE_PHOTO_COUPONS = 'photo_coupons';
        const TYPE_PHOTO_INVOICE = 'photo_invoice';
        const TYPE_PHOTO_LABEL = 'photo_label';
        const TYPE_CHECK = 'check';
        const TYPE_REPACK = 'repack';
        const TYPE_SEND_BACK = 'send_back';
        const TYPE_SEND_BACK_PART = 'send_back_part';
        const TYPE_CHECK_WEIGHT = 'check_weight';
        const TYPE_DIVIDE = 'divide';
        const TYPE_REMOVE = 'remove';
        const TYPE_MISC = 'misc';

        /**
         * @return mixed
         */
        public function countriesList()
        {
            /**
             * @var Module $client
             */
            $client = \Yii::$app->getModule('ffClient');

            return $client->doRequest('/api/reference/countries');
        }

        /**
         * @return mixed
         */
        public function deliveryMethods()
        {
            /**
             * @var Module $client
             */
            $client = \Yii::$app->getModule('ffClient');

            return $client->doRequest('/api/reference/delivery-methods');
        }

        //TODO: перенести все в апи, когда все устаканится

        /**
         * @return array
         */
        public function declMethods()
        {
            return ['usps' => 'USPS', 'qwair' => 'Qwair', 'ecopost' => 'Ecopost'];
        }

        public function specialRequestTypes()
        {
            return [
                self::TYPE_DIMENTIONS     => 'Measure clothes, shoes ($3 per item)',
                self::TYPE_PHOTO          => 'Take a photo of item ($3 per package)',
                self::TYPE_PHOTO_COUPONS  => 'Take a photo of coupons ($1 per coupon)',
                self::TYPE_PHOTO_INVOICE  => 'Take a photo of invoice ($3 per package)',
                self::TYPE_PHOTO_LABEL    => 'Take a photo of postal label ($1 per label)',
                self::TYPE_CHECK          => 'Compare items with invoice information (from $3)',
                self::TYPE_REPACK         => 'Re-pack outgoing parcel (from $5)',
                self::TYPE_SEND_BACK      => 'Return back to shop, whole box ($5)',
                self::TYPE_SEND_BACK_PART => 'Return back to shop, partly ($7)',
                self::TYPE_CHECK_WEIGHT   => 'Check package weight ($1)',
                self::TYPE_DIVIDE         => 'Divide package in several parts (from $5)',
                self::TYPE_REMOVE         => 'Remove package from my account - I don\'t need it! (free)',
                self::TYPE_MISC           => 'Misc (from $1)',
            ];
        }

    }