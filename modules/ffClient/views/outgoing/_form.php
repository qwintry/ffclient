<?php

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

    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\ActiveForm;

?>

<?php
    $form = ActiveForm::begin([
        'id'      => 'courier-label-form',
        'options' => [
            'class'   => 'form-horizontal col-lg-8',
            'enctype' => 'multipart/form-data',
        ],
    ]) ?>

<?= $form->errorSummary($model); ?>
<fieldset>
    <legend>Incomings</legend>
    <div class="row">
        <?= $form->field($model, 'incomingSelected', [
            'options' => [
                'class' => 'col-lg-12',
            ],
        ])->checkboxList($incomings); ?>
    </div>
</fieldset>

<fieldset>
    <legend>Delivery Details</legend>
    <div class="row">
        <?= $form->field($model, 'method', [
            'options' => [
                'class' => 'col-lg-3',
            ],
        ])->dropDownList(Yii::$app->getModule('ffClient')->reference->deliveryMethods()) ?>
    </div>
</fieldset>

<fieldset>
    <legend>Recipient Info</legend>
    <div class="row">
        <?= $form->field($model, 'address[firstName]', [
            'options' => [
                'class' => 'col-lg-4',
            ],
        ])->label('First Name') ?>
        <?= $form->field($model, 'address[lastName]', [
            'options' => [
                'class' => 'col-lg-4',
            ],
        ])->label('Last Name') ?>
        <?= $form->field($model, 'address[patronymic]', [
            'options' => [
                'class' => 'col-lg-4',
            ],
        ])->label('Patronymic') ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'address[email]', [
            'options' => [
                'class' => 'col-lg-4',
            ],
        ])->label('Email') ?>
        <?= $form->field($model, 'address[phone]', [
            'options' => [
                'class' => 'col-lg-4',
            ],
        ])->label('Phone') ?>
    </div>

    <div class="row">
        <?= $form->field($model, 'address[zip]', [
            'options' => [
                'class' => 'col-lg-4',
            ],
        ])->label('Zip') ?>
        <?= $form->field($model, 'address[country]', [
            'options' => [
                'class' => 'col-lg-4',
            ],
        ])->label('Country')->dropDownList(Yii::$app->getModule('ffClient')->reference->countriesList()) ?>
        <?= $form->field($model, 'address[city]', [
            'options' => [
                'class' => 'col-lg-4',
            ],
        ])->label('City') ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'address[line1]', [
            'options' => [
                'class' => 'col-lg-4',
            ],
        ])->label('Address Line 1') ?>
        <?= $form->field($model, 'address[line2]', [
            'options' => [
                'class' => 'col-lg-4',
            ],
        ])->label('Address Line 2') ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'address[passportNumber]', [
            'options' => [
                'class' => 'col-lg-4',
            ],
        ])->label('Passport Number') ?>
        <?= $form->field($model, 'address[passportIssueDate]', [
            'options' => [
                'class' => 'col-lg-4',
            ],
        ])->label('Passport Issue Date')->widget(\dosamigos\datepicker\DatePicker::classname(), [
            'clientOptions' => [
                'autoclose' => true,
                'format'    => 'dd.mm.yyyy',
            ],
        ]) ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'passportFiles[]', [
            'options' => [
                'class' => 'col-lg-4',
            ],
        ])->fileInput(['multiple' => true])->label('Passport Scans') ?>
    </div>
</fieldset>


<fieldset>
    <legend>Packing Instructions</legend>
    <div class="row">
        <?= $form->field($model, 'remove_invoices', [
            'options' => [
                'class' => 'col-lg-4',
            ],
        ])->checkbox() ?>
        <?= $form->field($model, 'security_tape', [
            'options' => [
                'class' => 'col-lg-4',
            ],
        ])->checkbox() ?>
        <?= $form->field($model, 'insurance', [
            'options' => [
                'class' => 'col-lg-4',
            ],
        ])->checkbox() ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'user_notes', [
            'options' => [
                'class' => 'col-lg-12',
            ],
        ])->textarea(['rows' => 3]) ?>
    </div>
</fieldset>

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
