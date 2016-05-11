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
        const ROUTE_INDEX = Module::ROUTE_INCOMING_INDEX;
        const ROUTE_UPDATE = Module::ROUTE_INCOMING_UPDATE;
        const ROUTE_VIEW = Module::ROUTE_INCOMING_VIEW;
        const METHOD_SAVE = 'PATCH';

        protected static $defaultFilter = [
            'expand' => 'specRequests,photosForApi,declaration,items',
        ];

    }