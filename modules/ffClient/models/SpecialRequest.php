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
        protected static $createRoute = Module::ROUTE_SPECIAL_REQUEST_CREATE;
        protected static $createMethod = 'POST';
    }