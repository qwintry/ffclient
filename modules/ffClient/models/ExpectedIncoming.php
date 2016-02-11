<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 11.02.2016
     * Time: 15:33
     */

    namespace app\modules\ffClient\models;

    use app\modules\ffClient\Module;

    class ExpectedIncoming extends ApiModel
    {
        protected static $indexRoute = Module::ROUTE_EXPECTED_INCOMING_INDEX;
        protected static $viewRoute = Module::ROUTE_EXPECTED_INCOMING_VIEW;
        protected static $updateRoute = Module::ROUTE_EXPECTED_INCOMING_UPDATE;
        protected static $createRoute = Module::ROUTE_EXPECTED_INCOMING_CREATE;
        protected static $defaultFilter = [
            'expand' => 'specRequests, declaration',
        ];

    }