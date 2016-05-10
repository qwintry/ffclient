<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 10.02.2016
     * Time: 12:08
     *
     * @var \app\modules\ffClient\models\ApiModel[] $items
     * @var \app\modules\ffClient\models\ApiModel $model
     * @var \yii\web\View $this
     */

    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

    $title = 'Edit declaration';
    $this->title = $title;
?>
<h1><?= $title ?></h1>
<?php
    $form = ActiveForm::begin([
        'id'                     => 'courier-label-form',
        'options'                => ['class' => 'form-horizontal'],
        'enableAjaxValidation'   => true,
        'enableClientValidation' => true,
    ]);
?>
<div class="row">
    <?= $form->field($model, 'carrier', [
        'options' => [
            'class' => 'col-lg-3',
        ],
    ])->dropDownList(Yii::$app->getModule('ffClient')->reference->declMethods()) ?>
    <?= $form->field($model, 'country', [
        'options' => [
            'class' => 'col-lg-3',
        ],
    ])->dropDownList(Yii::$app->getModule('ffClient')->reference->countriesList()) ?>
</div>

<?php foreach ($model->items as $i => $item): ?>
    <div class="item_holder">
        <?php if (isset($item->id)): ?>
            <h3>Edit item #<?= $item['id'] ?>
                <?= Html::a('Delete', '#', [
                    'class'   => 'btn btn-danger btn-sm',
                    'onclick' => 'Items.delete($(this))',
                ]); ?>
            </h3>
        <?php else: ?>
            <h3>Add new item</h3>
        <?php endif; ?>
        <div class="row">
            <?= $form->field($item, '['.$i.']descr', [
                'inputOptions' => [
                    'class' => 'form-control',
                ],
                'options'      => [
                    'class' => ' col-lg-6',
                ],
            ])->textarea() ?>
            <?= $form->field($item, '['.$i.']descrLocal', [
                'inputOptions' => [
                    'class' => 'form-control',
                ],
                'options'      => [
                    'class' => ' col-lg-6',
                ],
            ])->textarea() ?>
        </div>
        <div class="row">
            <?= $form->field($item, '['.$i.']totalValue', [
                'inputOptions' => [
                    'class' => 'form-control',
                ],
                'template'     => '
                {label}
                <div class="input-group">
                    {input}
                    <span class="input-group-addon">$</span>
                </div>
                {error}{hint}
            ',
                'options'      => [
                    'class' => ' col-lg-3',
                ],
            ]) ?>

            <?= $form->field($item, '['.$i.']totalWeight', [
                'inputOptions' => [
                    'class' => 'form-control',
                ],
                'template'     => '
                {label}
                <div class="input-group">
                    {input}
                    <span class="input-group-addon">lb</span>
                </div>
                {error}{hint}
            ',
                'options'      => [
                    'class' => 'col-lg-3',
                ],
            ])->textInput(['maxlength' => 5]) ?>

            <?= $form->field($item, '['.$i.']quantity', [
                'inputOptions' => [
                    'class' => 'form-control',
                ],
                'options'      => [
                    'class' => ' col-lg-3',
                ],
            ]) ?>
        </div>
        <hr>
    </div>
<?php endforeach; ?>

<div class="form-group">
    <div class="col-lg-11">
        <?= Html::submitButton(\Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
        <?= \yii\helpers\Html::a(\Yii::t('app', 'Cancel'), \yii\helpers\Url::to(['index']), [
            'class' => 'btn btn-link',
        ]) ?>
    </div>
</div>
<?php ActiveForm::end() ?>

<?php $this->registerJs('

    var Items = {
        itemHolderSelector: ".item_holder",
        delete: function($item) {
            $item.closest(this.itemHolderSelector).hide().remove();
            return false;
        },
    };

', \yii\web\View::POS_END, "items-management") ?>
