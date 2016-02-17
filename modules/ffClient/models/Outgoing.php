<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 11.02.2016
     * Time: 21:06
     */

    namespace app\modules\ffClient\models;

    use app\modules\ffClient\Module;

    class Outgoing extends ApiModel
    {
        const ROUTE_CREATE = Module::ROUTE_OUTGOING_CREATE;
        const ROUTE_VIEW = Module::ROUTE_OUTGOING_VIEW;
        const ROUTE_INDEX = Module::ROUTE_OUTGOING_INDEX;
        const ROUTE_PAY = '/api/outgoing/pay';

        protected static $defaultFilter = [
            'expand' => 'declaration, storeInvoice',
        ];

        public function pay()
        {
            $url = '/api/outgoing/pay?id='.$this->id;
            $response = self::doRequest($url, [], "POST");


        }
    }