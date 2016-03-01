<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 21.02.2016
     * Time: 11:59
     *
     * File contains FF Client Module API connection options
     */

    return [
        'bootstrap' => [
            'ffClient',
        ],
        'modules'   => [
            'ffClient' => [
                'class'   => 'app\modules\ffClient\Module',
                'apiKey'  => 'vvr7j9cNMaQ7njaYWf_avFWwZL4ql6ES',
                'siteUrl' => 'http://ff.qwintry.loc',
            ],
        ],
    ];