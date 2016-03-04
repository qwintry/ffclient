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

<h1>
    <?= $title ?>
</h1>

<?= Html::a('Back', \yii\helpers\Url::to(['index']), [
    'class' => 'btn btn-list',
]); ?>
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
    ],
]); ?>


<?= $this->render('@app/modules/ffClient/views/common/declaration-view', [
    'model'   => $model,
    'itemsProvider' => $declarationProvider,
]) ?>

<h2>Invoice:
    <?php if (!$model->invoice_paid): ?>
        <?= Html::a('Charge payment', \yii\helpers\Url::to(['pay', 'id' => $model->id]), [
            'class' => 'btn btn-success btn-sm',
        ]); ?>
    <?php else: ?>
        <small class="">Invoice Paid</small>
    <?php endif; ?>
</h2>
<?php if ($model->storeInvoice): ?>
    <table class="table table-striped">
        <tr>
            <td>Shipping Cost</td>
            <td>$<?= $model->storeInvoice->shipping ?></td>
        </tr>
        <tr>
            <td>Packing Cost</td>
            <td>$<?= $model->storeInvoice->packing ?></td>
        </tr>
        <tr>
            <td>Materials Cost</td>
            <td>$<?= $model->storeInvoice->materials ?></td>
        </tr>
        <tr>
            <td>Consolidation Cost</td>
            <td>$<?= $model->storeInvoice->consolidation ?></td>
        </tr>
        <tr>
            <td>Special Requests Cost</td>
            <td>$<?= $model->storeInvoice->specRequests ?></td>
        </tr>
        <tr>
            <td>Security Tape Cost</td>
            <td>$<?= $model->storeInvoice->securityTape ?></td>
        </tr>
        <tr>
            <td>Insurance Tape Cost</td>
            <td>$<?= $model->storeInvoice->insurance ?></td>
        </tr>
        <tr>
            <td>Storage Tape Cost</td>
            <td>$<?= $model->storeInvoice->storage ?></td>
        </tr>
        <tr>
            <td>Other Tape Cost</td>
            <td>$<?= $model->storeInvoice->other ?></td>
        </tr>
        <tr>
            <td class="info">TOTAL</td>
            <td class="info">$<?= $model->storeInvoice->total ?></td>
        </tr>
    </table>
<?php endif; ?>


<?= Html::a('Back', \yii\helpers\Url::to(['index']), [
    'class' => 'btn btn-list',
]); ?>
