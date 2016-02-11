<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 11.02.2016
     * Time: 12:30
     *
     * @var stdClass $model
     * @var \yii\data\ArrayDataProvider $declarationProvider
     */
    use yii\grid\GridView;
    use yii\helpers\Html;

    $title = $model->tracking." #".$model->id;
    $this->title = $title;

?>

    <h1><?= $title ?></h1>

<?= \yii\widgets\DetailView::widget([
    'model'      => $model,
    'attributes' => [
        'id',
        'tracking',
        'weight',
        'status',
        'remove_invoices:boolean',
        'security_tape:boolean',
        'insurance:boolean',
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
    ],
]); ?>

    <h2>Items in declaration:</h2>
<?= GridView::widget([
    'dataProvider' => $declarationProvider,
    'columns'      => [
        'id',
        'descr',
        'descr_ru',
        'line_value',
        'line_weight',
        'url',
        'qty',
    ],
]); ?>