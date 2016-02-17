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
        const ROUTE_INDEX = Module::ROUTE_EXPECTED_INCOMING_INDEX;
        const ROUTE_CREATE = Module::ROUTE_EXPECTED_INCOMING_CREATE;
        const ROUTE_UPDATE = Module::ROUTE_EXPECTED_INCOMING_UPDATE;
        const ROUTE_VIEW = Module::ROUTE_EXPECTED_INCOMING_VIEW;

        protected static $defaultFilter = [
            'expand' => 'specRequests, declaration',
        ];

    }