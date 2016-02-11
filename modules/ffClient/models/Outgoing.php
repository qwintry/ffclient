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
        protected static $createRoute = Module::ROUTE_OUTGOING_CREATE;
        protected static $viewRoute = Module::ROUTE_OUTGOING_VIEW;
        protected static $indexRoute = Module::ROUTE_OUTGOING_INDEX;

        protected static $defaultFilter = [
            'expand' => 'declaration, storeInvoice',
        ];
    }