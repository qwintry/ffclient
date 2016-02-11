<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 11.02.2016
     * Time: 15:33
     */

    namespace app\modules\ffClient\models;

    use app\modules\ffClient\Module;

    class Incoming extends ApiModel
    {
        protected static $indexRoute = Module::ROUTE_INCOMING_INDEX;
        protected static $viewRoute = Module::ROUTE_INCOMING_VIEW;
        protected static $updateRoute = Module::ROUTE_INCOMING_UPDATE;
        protected static $saveMethod = 'PATCH';
        protected static $defaultFilter = [
            'expand' => 'specRequests,packageThumbnails,declaration',
        ];

    }