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
     * @var \yii\web\View $this
     */

    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\ActiveForm;

?>

<?php
    $form = ActiveForm::begin([
        'id'      => 'outgoing-create-form',
        'options' => [
            'class'   => '',
            'enctype' => 'multipart/form-data',
        ],
    ]) ?>

<?= $form->errorSummary($model); ?>
<fieldset>
    <legend>Incomings</legend>
    <div class="row">
        <?php if ($incomings): ?>
            <?= $form->field($model, 'incomingSelected', [
                'options' => [
                    'class' => 'col-lg-12',
                ],
            ])->checkboxList($incomings); ?>
        <?php else: ?>
            <div class="col-md-8 text-muted">
                You doesn't have incoming with status "in stock".
            </div>
        <?php endif; ?>
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
    <div class="row qwair_only hide">
        <?= $form->field($model, 'deliveryType', [
            'options' => [
                'class' => 'col-lg-3',
            ],
        ])->radioList(['courier' => 'Courier', 'pickup' => 'Pickup']) ?>
        <?= $form->field($model, 'deliveryPickup', [
            'options' => [
                'class' => 'col-lg-9',
            ],
        ])->dropDownList(Yii::$app->getModule('ffClient')->reference->deliveryPickupPoints(), [
            'prompt' => ' ',
        ]) ?>
    </div>
</fieldset>

<fieldset>
    <legend>Recipient Info</legend>
    <div class="row">
        <?= $form->field($model, 'address[firstName]', [
            'template' => '{label} {input} {customError}',
            'parts'    => [
                '{customError}' => '<div class="has-error">'.Html::error($model, 'firstName', [
                        'class' => 'help-block',
                    ]).'</div>',
            ],
            'options'  => [
                'class' => 'col-lg-4',
            ],
        ])->label('First Name') ?>
        <?= $form->field($model, 'address[lastName]', [
            'template' => '{label} {input} {customError}',
            'parts'    => [
                '{customError}' => '<div class="has-error">'.Html::error($model, 'lastName', [
                        'class' => 'help-block',
                    ]).'</div>',
            ],
            'options'  => [
                'class' => 'col-lg-4',
            ],
        ])->label('Last Name') ?>
        <?= $form->field($model, 'address[patronymic]', [
            'template' => '{label} {input} {customError}',
            'parts'    => [
                '{customError}' => '<div class="has-error">'.Html::error($model, 'patronymic', [
                        'class' => 'help-block',
                    ]).'</div>',
            ],
            'options'  => [
                'class' => 'col-lg-4',
            ],
        ])->label('Patronymic') ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'address[email]', [
            'template' => '{label} {input} {customError}',
            'parts'    => [
                '{customError}' => '<div class="has-error">'.Html::error($model, 'email', [
                        'class' => 'help-block',
                    ]).'</div>',
            ],
            'options'  => [
                'class' => 'col-lg-4',
            ],
        ])->label('Email') ?>
        <?= $form->field($model, 'address[phone]', [
            'template' => '{label} {input} {customError}',
            'parts'    => [
                '{customError}' => '<div class="has-error">'.Html::error($model, 'phone', [
                        'class' => 'help-block',
                    ]).'</div>',
            ],
            'options'  => [
                'class' => 'col-lg-4',
            ],
        ])->label('Phone') ?>
    </div>

    <div class="row">
        <?= $form->field($model, 'address[zip]', [
            'template' => '{label} {input} {customError}',
            'parts'    => [
                '{customError}' => '<div class="has-error">'.Html::error($model, 'zip', [
                        'class' => 'help-block',
                    ]).'</div>',
            ],
            'options'  => [
                'class' => 'col-lg-4',
            ],
        ])->label('Zip') ?>
        <?= $form->field($model, 'address[country]', [
            'template' => '{label} {input} {customError}',
            'parts'    => [
                '{customError}' => '<div class="has-error">'.Html::error($model, 'country', [
                        'class' => 'help-block',
                    ]).'</div>',
            ],
            'options'  => [
                'class' => 'col-lg-4',
            ],
        ])->label('Country')->dropDownList(Yii::$app->getModule('ffClient')->reference->countriesList(), [
            'prompt' => '-- Select country',
        ]) ?>
        <?= $form->field($model, 'address[city]', [
            'template' => '{label} {input} {customError}',
            'parts'    => [
                '{customError}' => '<div class="has-error">'.Html::error($model, 'city', [
                        'class' => 'help-block',
                    ]).'</div>',
            ],
            'options'  => [
                'class' => 'col-lg-4',
            ],
        ])->label('City') ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'address[line1]', [
            'template' => '{label} {input} {customError}',
            'parts'    => [
                '{customError}' => '<div class="has-error">'.Html::error($model, 'line1', [
                        'class' => 'help-block',
                    ]).'</div>',
            ],
            'options'  => [
                'class' => 'col-lg-4',
            ],
        ])->label('Address Line 1') ?>
        <?= $form->field($model, 'address[line2]', [
            'template' => '{label} {input} {customError}',
            'parts'    => [
                '{customError}' => '<div class="has-error">'.Html::error($model, 'line2', [
                        'class' => 'help-block',
                    ]).'</div>',
            ],
            'options'  => [
                'class' => 'col-lg-4',
            ],
        ])->label('Address Line 2') ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'address[passportNumber]', [
            'template' => '{label} {input} {customError}',
            'parts'    => [
                '{customError}' => '<div class="has-error">'.Html::error($model, 'passportNumber', [
                        'class' => 'help-block',
                    ]).'</div>',
            ],
            'options'  => [
                'class' => 'col-lg-4',
            ],
        ])->label('Passport Number') ?>
        <?= $form->field($model, 'address[passportIssueDate]', [
            'template' => '{label} {input} {customError}',
            'parts'    => [
                '{customError}' => '<div class="has-error">'.Html::error($model, 'passportIssueDate', [
                        'class' => 'help-block',
                    ]).'</div>',
            ],
            'options'  => [
                'class' => 'col-lg-4',
            ],
        ])->label('Passport Issue Date')->widget(\dosamigos\datepicker\DatePicker::className(), [
            'clientOptions' => [
                'autoclose' => true,
                'format'    => 'dd.mm.yyyy',
            ],
        ]) ?>
        <?= $form->field($model, 'address[passportIssuerInfo]', [
            'template' => '{label} {input} {customError}',
            'parts'    => [
                '{customError}' => '<div class="has-error">'.Html::error($model, 'passportIssuerInfo', [
                        'class' => 'help-block',
                    ]).'</div>',
            ],
            'options'  => [
                'class' => 'col-lg-4',
            ],
        ])->label('Passport Issuer Info') ?>
        <?= $form->field($model, 'address[passportCountry]', [
            'template' => '{label} {input} {customError}',
            'parts'    => [
                '{customError}' => '<div class="has-error">'.Html::error($model, 'passportCountry', [
                        'class' => 'help-block',
                    ]).'</div>',
            ],
            'options'  => [
                'class' => 'col-lg-4',
            ],
        ])->label('Passport Country')->dropDownList(Yii::$app->getModule('ffClient')->reference->countriesList(), [
            'prompt' => '-- Select country',
        ]) ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'passportFiles[]', [
            'options' => [
                'class' => 'col-lg-4',
            ],
        ])->fileInput(['multiple' => true, 'class' => 'btn btn-default btn-lg'])->label('Passport Scans') ?>
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

<fieldset>
    <div class="row">
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
</fieldset>

<?php ActiveForm::end() ?>

<?= $this->registerJs(/** @lang JavaScript */
    'var OutgoingForm = function($form) {
        var $deliveryMethodSelect = $form.find("#outgoingform-method");
        var $qwairOnlyBlock = $form.find(".qwair_only");
        var $deliveryTypeSelect = $form.find("#outgoingform-deliverytype");
        var $deliveryPickupSelect = $form.find("#outgoingform-deliverypickup");
        
        var init = function() {
            $qwairOnlyBlock.hide().removeClass("hide");
            if($deliveryMethodSelect.val() == "qwair") {
                $qwairOnlyBlock.fadeIn();
            }
        }();
        
        $deliveryMethodSelect.on("change", function() {
            if($(this).val() == "qwair") {
                $qwairOnlyBlock.fadeIn();
            } else {
                $qwairOnlyBlock.hide();
                $deliveryTypeSelect.find("input").each(function(i, input) {
                    $(input).val("").attr("checked", false);
                });
                $deliveryPickupSelect.val("");
            }
        });
    }($("#outgoing-create-form"));
') ?>