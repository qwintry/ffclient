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
        const METHOD_CREATE = 'POST';

        const RELATED_TYPE_INCOMING = 'incoming';
        const RELATED_TYPE_EXPECTED_INCOMING = 'expectedIncoming';
    }