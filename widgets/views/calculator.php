<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 21.07.2016
     * Time: 14:02
     *
     * @var \app\models\Calculator $model
     */

    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;

?>

<div class="calculator">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 text-center">
            <h1>
                <?= \Yii::t('app', 'How much does it cost?') ?><br>
                <small><?= \Yii::t('app',
                        'Calculate the costs of Qwintry services. All you need is your outgoing package\'s weight.') ?></small>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 text-center">
            <?php
                $form = ActiveForm::begin([
                    'enableAjaxValidation'   => false,
                    'enableClientValidation' => true,
                    'options'                => [
                        'data-pjax' => true,
                    ],
                ]) ?>
            <div class="row">
                <div class="col-lg-2">
                    <?= $form->field($model, 'weight')->textInput(['type' => 'number']) ?>
                </div>
                <div class="col-lg-2">
                    <?= $form->field($model, 'weightMeasurementSystem')
                        ->dropDownList(\app\widgets\Calculator::getMeasurementSystems())
                        ->label('&nbsp;') ?>
                </div>
                <div class="col-lg-4">
                    <?= $form->field($model, 'country')->dropDownList(\app\widgets\Calculator::getCountries()) ?>
                </div>
                <div class="col-lg-2">
                    <?= Html::submitButton(\Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
            <?php ActiveForm::end() ?>

            <div class="row">

                <div class="col-lg-12">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#qwair" aria-controls="qwair" role="tab" data-toggle="tab">
                                <div class="logo-holder">
                                    <?= Html::img('/images/icon-method-qwair.png', [
                                        'alt' => 'Qwintry Air',
                                    ]) ?>
                                </div>
                                <h3>Qwintry Air</h3>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#ecopost" aria-controls="ecopost" role="tab" data-toggle="tab">
                                <div class="logo-holder">
                                    <?= Html::img('/images/icon-method-ecopost.png', [
                                        'alt' => 'Qwintry Air',
                                    ]) ?>
                                </div>
                                <h3>Qwintry Eco Post</h3>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#spsr" aria-controls="spsr" role="tab" data-toggle="tab">
                                <div class="logo-holder">
                                    <?= Html::img('/images/icon-method-spsr.png', [
                                        'alt' => 'Qwintry Air',
                                    ]) ?>
                                </div>
                                <h3>SPSR</h3>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#priority" aria-controls="priority" role="tab" data-toggle="tab">
                                <div class="logo-holder">
                                    <?= Html::img('/images/icon-method-priority.png', [
                                        'alt' => 'Qwintry Air',
                                    ]) ?>
                                </div>
                                <h3>Priority</h3>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#express" aria-controls="express" role="tab" data-toggle="tab">
                                <div class="logo-holder">
                                    <?= Html::img('/images/icon-method-express.png', [
                                        'alt' => 'Qwintry Air',
                                    ]) ?>
                                </div>
                                <h3>Express</h3>
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="qwair">
                            <div class="clearfix calc-method-qwair" style="display: block;">
                                <div class="row">
                                    <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-3 col-md-offset-0 calc-method-text-misc">
                                        <div class="bootstrap-help-padding-left col-md-offset-2">
                                            <div class="marker-recommend alert alert-warning">Recommended</div>
                                            <div class="marker-delivery">
                                                <div class="delivery-icon"></div>
                                                <span>Estimated delivery time: ~16-22 days<div class="delivery-opts">Delivery options in Сыктывкар: <label class="marker-courier label label-primary">COURIER</label> &amp; <label class="marker-pickup label label-default"><a href="http://logistics.qwintry.com/ru/map?city=%D0%A1%D1%8B%D0%BA%D1%82%D1%8B%D0%B2%D0%BA%D0%B0%D1%80" target="_blank" style="color:#FFF">PICKUP (3)</a></label></div></span>
                                            </div>
                                            <div class="marker-customs">
                                                <div class="customs-limit-icon"></div>
                                                <span>Customs limit: 1000 EUR per month</span></div>
                                            <!--<div class="forum-icon"></div><span><a href="/en/node/409819">Forum discussion</a></span>-->
                                        </div>
                                    </div>
                                    <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-0  calc-method-text">
                                        <div class="method-text"><p>Qwintry Air is our pride: it’s our own method of
                                                delivery. We use the most reliable companies — from trucking companies
                                                and customs brokers to home delivery services — streamlining the whole
                                                process through our efficient and cost-effective IT system.</p></div>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <span class="calc-field"><span data-toggle="popover" data-placement="bottom" class="icon-question-mark" data-content="The total weight of the parcel is in pounds" data-original-title="" title="">Weight</span></span>
                                                </td>
                                                <td><span class="calc-field">2.21lb(1kg)</span></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="calc-field"><span data-toggle="popover" data-placement="bottom" class="icon-question-mark" data-content="Receiving of your packages by Qwintry warehouse" data-original-title="" title="">Receiving of incoming packages</span></span>
                                                </td>
                                                <td><span class="calc-field">$0</span></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="calc-field"><span data-toggle="popover" data-placement="bottom" class="icon-question-mark" data-content="Consolidation of all your purchases into one box" data-original-title="" title="">Consolidation</span></span>
                                                </td>
                                                <td><span class="calc-field">$0</span></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="calc-field"><span data-toggle="popover" data-placement="bottom" class="icon-question-mark" data-content="Storage of your purchases at Qwintry warehouse" data-original-title="" title="">45 days of storage</span></span>
                                                </td>
                                                <td><span class="calc-field">$0</span></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="calc-field"><span data-toggle="popover" data-placement="bottom" class="icon-question-mark" data-content="Shipping cost, excluding packaging and payment system commissions" data-original-title="" title="">Shipping cost</span></span>
                                                </td>
                                                <td>
                                                    <span class="calc-field"><span style="background:#fff88b;padding:2px">$22</span></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="calc-field"><span data-toggle="popover" data-placement="bottom" class="icon-question-mark" data-content="The cost of packaging materials is based on the weight of the parcel" data-original-title="" title="">Packing materials</span></span>
                                                </td>
                                                <td><span class="calc-field">$3</span></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="calc-field"><span data-toggle="popover" data-placement="bottom" class="icon-question-mark" data-content="The commission of payment gateway for funds transfer" data-original-title="" title="">Payment gateway fee</span></span>
                                                </td>
                                                <td><span class="calc-field">$1.1</span></td>
                                            </tr>
                                            <tr class="total">
                                                <td>
                                                    <span class="calc-field"><span data-toggle="popover" data-placement="bottom" class="icon-question-mark" data-content="The final shipping cost of the parcel depends on its final weight" data-original-title="" title="">Total</span></span>
                                                </td>
                                                <td><span class="calc-field">$26.1</span></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="ecopost">.24.</div>
                        <div role="tabpanel" class="tab-pane" id="spsr">.234.</div>
                        <div role="tabpanel" class="tab-pane" id="priority">.2334.</div>
                        <div role="tabpanel" class="tab-pane" id="express">.2334.</div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 calc-help calc-help-1">
                    <h4><?= \Yii::t('app', 'Additional Services') ?></h4>
                    <p><?=\Yii::t('app', '_calc_help_text_1') ?></p>
                </div>

                <div class="col-lg-4 calc-help calc-help-2">
                    <h4><?= \Yii::t('app', 'Save Money') ?></h4>
                    <p><?=\Yii::t('app', '_calc_help_text_2') ?></p>
                </div>
                <div class="col-lg-4 calc-help calc-help-3">
                    <h4><?= \Yii::t('app', 'Insurance') ?></h4>
                    <p><?=\Yii::t('app', '_calc_help_text_3') ?></p>
                </div>
            </div>

        </div>
    </div>
</div>
