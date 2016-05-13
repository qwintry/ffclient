<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 11.02.2016
     * Time: 11:59
     *
     * @var \yii\web\View $this
     * @var \yii\data\ArrayDataProvider $provider
     */
    $title = "Outgoing";
    $this->title = $title;

    use yii\grid\GridView;
    use yii\helpers\Html;
    use yii\helpers\Url;

?>
<h1>
    <?= $title; ?>
    <?= Html::a('Create', Url::to(['create']), [
        'class' => 'btn btn-success btn-sm',
    ]) ?>
</h1>
<?= GridView::widget([
    'dataProvider' => $provider,
    'columns'      => [
        'id',
        'tracking',
        'weight',
//        'status',
        'remove_invoices:boolean',
        'security_tape:boolean',
        'insurance:boolean',
        //        'user_notes',
        //        'operator_notes',
//        'type',
        'method',
        'create_time:datetime',
        'update_time:datetime',
        //        'invoice_packing',
        //        'invoice_materials',
        //        'invoice_shipping',
        //        'invoice_insurance',
        //        'invoice_consolidation',
        //        'shipping_retail_cost',
        //        'invoice_spec_requests',
        //        'invoice_storage',
        //        'invoice_security_tape',
        //        'invoice_other',
        'invoice_total',
        //        'shipping_label_file',
        //        'store_id',
//        'hub_id',
        //        'invoice_paid',
        //        'invoice_create_time',
        //        'dimensions',
        //        'items_value',
        //        'location',
        //        'customerInvoiceId',
        //        'storeInvoiceId',
        //        'addressId',
        //        'baseInvoiceId',
        //        'autoCharge',
        //        'deliveryType',
        //        'deliveryPickup',
        //        'storeInvoice',
        //        'declaration',

        [
            'class'    => \yii\grid\ActionColumn::className(),
            'template' => '<nobr>{view}&nbsp;{pay}</nobr>',
            'buttons'  => [
                'view' => function ($url, $model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',
                        Url::to(['view', 'id' => $model->id]));
                },
                'pay'  => function ($url, $model, $key) {
                    if (!$model->invoice_paid) {
                        return Html::a('<i class="glyphicon glyphicon-usd"></i>', Url::to(['pay', 'id' => $model->id]),
                            [
                                'title' => "Charge payment",
                            ]);
                    }

                    return '<span title="Invoice Paid" class="label label-success"><i class="glyphicon glyphicon-usd"></i></span>';
                },
            ],
        ],
    ],
]); ?>
