<?php

    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 10.02.2016
     * Time: 11:07
     *
     * @var \yii\base\View $this
     * @var \app\modules\ffClient\models\forms\IncomingForm $model
     */

    use app\models\User;
    use app\modules\ffClient\models\ExpectedIncoming;
    use app\modules\ffClient\models\Outgoing;
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\ActiveForm;

?>

<?php
    $form = ActiveForm::begin([
        'id'                     => 'courier-label-form',
        'options'                => ['class' => 'form-horizontal'],
        'enableAjaxValidation'   => true,
        'enableClientValidation' => true,
    ]);
?>
<div class="row">
    <?= $form->field($model, 'tracking', [
        'options' => [
            'class' => 'col-lg-3',
        ],
    ]); ?>
    <?= $form->field($model, 'shop', [
        'options' => [
            'class' => 'col-lg-3',
        ],
    ]); ?>
    <?= $form->field($model, 'status', [
        'options' => [
            'class' => 'col-lg-3',
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
            'class' => 'col-lg-3',
        ],
    ])->textInput(['maxlength' => 5]) ?>
</div>

<div class="row">
    <?= $form->field($model, 'user_id', [
        'options' => [
            'class' => 'col-lg-4',
        ],
    ])->dropDownList(User::getList()); ?>
    <?= $form->field($model, 'outgoing_id', [
        'options' => [
            'class' => 'col-lg-4',
        ],
    ])->dropDownList(Outgoing::getList('id', 'tracking')); ?>
    <?= $form->field($model, 'expected_incoming_id', [
        'options' => [
            'class' => 'col-lg-4',
        ],
    ])->dropDownList(ExpectedIncoming::getList('id', 'tracking')); ?>
</div>

<div class="row">
    <?= $form->field($model, 'decl_type', [
        'options' => [
            'class' => 'col-lg-4',
        ],
    ])->textInput(['readonly' => true]); ?>
    <?= $form->field($model, 'op_notes', [
        'options' => [
            'class' => 'col-lg-4',
        ],
    ])->textInput(['readonly' => true]); ?>
    <?= $form->field($model, 'hub_id', [
        'options'      => [
            'class' => 'col-lg-4',
        ],
    ])->textInput(['readonly' => true]); ?>
</div>

<div class="row">
    <?= $form->field($model, 'location', [
        'options' => [
            'class' => 'col-lg-4',
        ],
    ]); ?>
    <?= $form->field($model, 'part_number', [
        'options' => [
            'class' => 'col-lg-4',
        ],
    ]); ?>
</div>

<div class="form-group">
    <div class="col-lg-11">
        <?= Html::submitButton(\Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        <?= Html::a(\Yii::t('app', 'Cancel'), Url::to(['view', 'id' => $model->id]), [
            'class' => 'btn btn-link',
        ]); ?>
    </div>
</div>
<?php ActiveForm::end() ?>
