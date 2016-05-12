<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 11.02.2016
     * Time: 20:24
     */

    namespace app\modules\ffClient\models;

    use app\modules\ffClient\Module;

    class SpecialRequest extends ApiModel
    {
        const ROUTE_CREATE = Module::ROUTE_SPECIAL_REQUEST_CREATE;
        const ROUTE_VIEW = Module::ROUTE_SPECIAL_REQUEST_VIEW;
        const ROUTE_UPDATE = Module::ROUTE_SPECIAL_REQUEST_UPDATE;

        const METHOD_CREATE = 'POST';
        const METHOD_SAVE = 'PUT';

        const RELATED_TYPE_INCOMING = 'incoming';
        const RELATED_TYPE_EXPECTED_INCOMING = 'expected_incoming';

        const STATUS_ACTIVE = 'active';
        const STATUS_CANCELED = 'canceled';
        const STATUS_COMPLETED = 'completed';

        protected static $defaultFilter = [
            'expand' => 'customerFilesForApi,operatorFilesForApi',
        ];
    }