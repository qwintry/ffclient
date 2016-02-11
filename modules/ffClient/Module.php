<?php

    namespace app\modules\ffClient;

    use yii\helpers\ArrayHelper;

    class Module extends \yii\base\Module
    {
        const ROUTE_USER_INDEX = 'user_index';
        const ROUTE_USER_CREATE = 'user_create';
        const ROUTE_USER_UPDATE = 'user_update';
        const ROUTE_EXPECTED_INCOMING_INDEX = 'expected_incoming_index';
        const ROUTE_EXPECTED_INCOMING_VIEW = 'expected_incoming_view';
        const ROUTE_EXPECTED_INCOMING_UPDATE = 'expected_incoming_update';
        const ROUTE_EXPECTED_INCOMING_CREATE = 'exptected_incoming_create';
        const ROUTE_INCOMING_INDEX = 'incoming_index';
        const ROUTE_INCOMING_VIEW = 'incoming_view';
        const ROUTE_INCOMING_UPDATE = 'incoming_update';
        const ROUTE_SPECIAL_REQUEST_CREATE = 'special_request_create';
        const ROUTE_OUTGOING_INDEX = 'outgoing_index';
        const ROUTE_OUTGOING_VIEW = 'outgoing_view';
        const ROUTE_OUTGOING_CREATE = 'outgoing_create';

        public $controllerNamespace = 'app\modules\ffClient\controllers';

        /**
         * Key for access to qwintry fulfillment api
         * @var string
         */
        public $apiKey;
        /**
         * Url of qwintry fulfillment api
         * @var string
         */
        public $siteUrl;

        /**
         * Api routes
         * @var array
         */
        public $routes = [
            //user
            self::ROUTE_USER_INDEX               => 'api/user/index',
            self::ROUTE_USER_CREATE              => 'api/user/create',
            self::ROUTE_USER_UPDATE              => 'api/user/update',
            //expected incoming
            self::ROUTE_EXPECTED_INCOMING_INDEX  => 'api/expected-incoming/index',
            self::ROUTE_EXPECTED_INCOMING_VIEW   => 'api/expected-incoming/view',
            self::ROUTE_EXPECTED_INCOMING_UPDATE => 'api/expected-incoming/update',
            self::ROUTE_EXPECTED_INCOMING_CREATE => 'api/expected-incoming/create',
            //incoming
            self::ROUTE_INCOMING_INDEX           => 'api/incoming/index',
            self::ROUTE_INCOMING_VIEW            => 'api/incoming/view',
            self::ROUTE_INCOMING_UPDATE          => 'api/incoming/update',
            //spec request
            self::ROUTE_SPECIAL_REQUEST_CREATE   => 'api/spec-request/create',
            //outgoing
            self::ROUTE_OUTGOING_INDEX           => 'api/outgoing/index',
            self::ROUTE_OUTGOING_VIEW            => 'api/outgoing/view',
            self::ROUTE_OUTGOING_CREATE          => 'api/outgoing/create',
        ];

        /**
         * Attributes for create or update expected incoming via api
         * @var array
         */
        public static $ExpectedIncomingForm = [
            'tracking',
            'user_id',
            'shop',
            'decl_type',
            'hub_id',
            'received',
            'user_notes',
            'processed',
        ];

        /**
         * Attributes for create or update incoming via api
         * @var array
         */
        public static $IncomingForm = [
            'tracking',
            'shop',
            'status',
            'weight',
            'user_id',
            'outgoing_id',
            'decl_type',
            'op_notes',
            'hub_id',
            'location',
            'expected_incoming_id',
            'part_number',
        ];

        /**
         * Attributes for create or update incoming's declaration via api
         * @var array
         */
        public static $DeclarationForm = [
            'descr',
            'descr_ru',
            'line_value',
            'line_weight',
            'url',
            'qty',
        ];

        /**
         * Attributes for create or update incoming's special request via api
         * @var array
         */
        public static $SpecialRequestForm = [
            'customerNotes',
            'type',
            'status',
            'notes',
            'handling',
            'charge',
            'authorId',
            'hub_id',
        ];

        /**
         * Attributes for create or update outgoing via api
         * @var array
         */
        public static $OutgoingForm = [
            'tracking',
            'weight',
            'status',
            'remove_invoices',
            'security_tape',
            'insurance',
            'user_notes',
            'operator_notes',
            'type',
            'method',
            'create_time',
            'update_time',
            'invoice_packing',
            'invoice_materials',
            'invoice_shipping',
            'invoice_insurance',
            'invoice_consolidation',
            'shipping_retail_cost',
            'invoice_spec_requests',
            'invoice_storage',
            'invoice_security_tape',
            'invoice_other',
            'invoice_total',
            'shipping_label_file',
            'store_id',
            'hub_id',
            'invoice_paid',
            'invoice_create_time',
            'dimensions',
            'items_value',
            'location',
            'customerInvoiceId',
            'storeInvoiceId',
            'addressId',
            'baseInvoiceId',
            'autoCharge',
            'deliveryType',
            'deliveryPickup',
            'storeInvoice',
        ];

        public function init()
        {
            parent::init();
            // custom initialization code goes here
        }

        /**
         * @param $route
         * @param null $data
         * @param null $method
         *
         * @return mixed
         */
        public function doRequest($route, $data = null, $method = null)
        {
            if ($moduleRoute = $this->getApiRoute($route)) {
                $route = $moduleRoute;
            }

            $url = $this->siteUrl.'/'.ltrim($route, "/");

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$this->apiKey));

            if ($method) {
                if ($method == "POST") {
                    curl_setopt($ch, CURLOPT_POST, true);
                } else {
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
                }
            }

            if ($data) {
                if (is_array($data)) {
                    $data = http_build_query($data);
                }
                if ($method === null) {
                    curl_setopt($ch, CURLOPT_POST, true);
                }
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            }
            curl_setopt($ch, CURLOPT_USERAGENT, 'FF API Client 1.0');
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            $response = curl_exec($ch);
            curl_close($ch);

            return json_decode($response);
        }

        /**
         * @param $route
         *
         * @return mixed
         */
        public function getApiRoute($route)
        {
            return ArrayHelper::getValue($this->routes, $route);
        }
    }
