<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\ActiveForm;

    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 10.02.2016
     * Time: 11:07
     *
     * @var \yii\base\View $this
     * @var \app\modules\ffClient\models\forms\OutgoingForm $model
     * @var array $incomings
     */

    //    $attributes = Module::$OutgoingForm;
    //    var_dump($attributes);
?>

<?php
    $form = ActiveForm::begin([
        'id'                     => 'courier-label-form',
        'options'                => ['class' => 'form-horizontal'],
        'enableAjaxValidation'   => true,
        'enableClientValidation' => true,
    ]) ?>

<?= $form->errorSummary($model); ?>
<div class="row">
    <?= $form->field($model, 'incomingSelected', [
        'options' => [
            'class' => 'col-lg-12',
        ],
    ])->checkboxList($incomings); ?>
</div>
<div class="row">
    <?= $form->field($model, 'tracking', [
        'options' => [
            'class' => 'col-lg-2',
        ],
    ]); ?>
    <?= $form->field($model, 'weight', [
        'template' => '
        {label}
        <div class="input-group">
            {input}
            <span class="input-group-addon">lb</span>
        </div>
        {error}{hint}
        ',
        'options'  => [
            'class' => 'col-lg-2',
        ],
    ])->textInput(['maxlength' => 5]) ?>

    <?= $form->field($model, 'status', [
        'options' => [
            'class' => 'col-lg-2',
        ],
    ]); ?>
    <?= $form->field($model, 'type', [
        'options' => [
            'class' => 'col-lg-2',
        ],
    ]); ?>
    <?= $form->field($model, 'method', [
        'options' => [
            'class' => 'col-lg-2',
        ],
    ]); ?>
</div>
<div class="row">
    <?= $form->field($model, 'remove_invoices', [
        'options' => [
            'class' => 'col-lg-2',
        ],
    ])->checkbox(); ?>

    <?= $form->field($model, 'security_tape', [
        'options' => [
            'class' => 'col-lg-2',
        ],
    ])->checkbox(); ?>

    <?= $form->field($model, 'insurance', [
        'options' => [
            'class' => 'col-lg-2',
        ],
    ])->checkbox(); ?>
</div>

<div class="row">
    <?= $form->field($model, 'user_notes', [
        'options' => [
            'class' => 'col-lg-6',
        ],
    ])->textarea(['rows' => 3]); ?>
    <?= $form->field($model, 'operator_notes', [
        'options' => [
            'class' => 'col-lg-6',
        ],
    ])->textarea(['rows' => 3]); ?>
</div>

<div class="row">
    <?= $form->field($model, 'invoice_packing', [
        'template' => '
        {label}
        <div class="input-group">
            {input}
            <span class="input-group-addon">$</span>
        </div>
        {error}{hint}
        ',
        'options'  => [
            'class' => 'col-lg-2',
        ],
    ]) ?>
    <?= $form->field($model, 'invoice_materials', [
        'template' => '
        {label}
        <div class="input-group">
            {input}
            <span class="input-group-addon">$</span>
        </div>
        {error}{hint}
        ',
        'options'  => [
            'class' => 'col-lg-2',
        ],
    ]) ?>
    <?= $form->field($model, 'invoice_shipping', [
        'template' => '
        {label}
        <div class="input-group">
            {input}
            <span class="input-group-addon">$</span>
        </div>
        {error}{hint}
        ',
        'options'  => [
            'class' => 'col-lg-2',
        ],
    ]) ?>
    <?= $form->field($model, 'invoice_insurance', [
        'template' => '
        {label}
        <div class="input-group">
            {input}
            <span class="input-group-addon">$</span>
        </div>
        {error}{hint}
        ',
        'options'  => [
            'class' => 'col-lg-2',
        ],
    ]) ?>
    <?= $form->field($model, 'invoice_consolidation', [
        'template' => '
        {label}
        <div class="input-group">
            {input}
            <span class="input-group-addon">$</span>
        </div>
        {error}{hint}
        ',
        'options'  => [
            'class' => 'col-lg-2',
        ],
    ]) ?>
    <?= $form->field($model, 'shipping_retail_cost', [
        'template' => '
        {label}
        <div class="input-group">
            {input}
            <span class="input-group-addon">$</span>
        </div>
        {error}{hint}
        ',
        'options'  => [
            'class' => 'col-lg-2',
        ],
    ]) ?>
</div>

<div class="row">
    <?= $form->field($model, 'invoice_spec_requests', [
        'template' => '
        {label}
        <div class="input-group">
            {input}
            <span class="input-group-addon">$</span>
        </div>
        {error}{hint}
        ',
        'options'  => [
            'class' => 'col-lg-2',
        ],
    ]) ?>
    <?= $form->field($model, 'invoice_storage', [
        'template' => '
        {label}
        <div class="input-group">
            {input}
            <span class="input-group-addon">$</span>
        </div>
        {error}{hint}
        ',
        'options'  => [
            'class' => 'col-lg-2',
        ],
    ]) ?>
    <?= $form->field($model, 'invoice_security_tape', [
        'template' => '
        {label}
        <div class="input-group">
            {input}
            <span class="input-group-addon">$</span>
        </div>
        {error}{hint}
        ',
        'options'  => [
            'class' => 'col-lg-2',
        ],
    ]) ?>
    <?= $form->field($model, 'invoice_other', [
        'template' => '
        {label}
        <div class="input-group">
            {input}
            <span class="input-group-addon">$</span>
        </div>
        {error}{hint}
        ',
        'options'  => [
            'class' => 'col-lg-2',
        ],
    ]) ?>
    <?= $form->field($model, 'invoice_total', [
        'template' => '
        {label}
        <div class="input-group">
            {input}
            <span class="input-group-addon">$</span>
        </div>
        {error}{hint}
        ',
        'options'  => [
            'class' => 'col-lg-2',
        ],
    ]) ?>
</div>

<div class="row">
    <?= $form->field($model, 'dimensions', [
        'options' => [
            'class' => 'col-lg-4',
        ],
    ]); ?>
    <?= $form->field($model, 'items_value', [
        'template' => '
        {label}
        <div class="input-group">
            {input}
            <span class="input-group-addon">$</span>
        </div>
        {error}{hint}
        ',
        'options'  => [
            'class' => 'col-lg-4',
        ],
    ]) ?>
</div>

<div class="form-group">
    <div class="col-lg-11">
        <?= Html::submitButton(\Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        <?php if (isset($model->id)): ?>
            <?= Html::a(\Yii::t('app', 'Cancel'), Url::to(['view', 'id' => $model->id]), [
                'class' => 'btn btn-link',
            ]); ?>
        <?php else: ?>
            <?= Html::a(\Yii::t('app', 'Cancel'), Url::to(['index']), [
                'class' => 'btn btn-link',
            ]); ?>
        <?php endif; ?>
    </div>
</div>
<?php ActiveForm::end() ?>
