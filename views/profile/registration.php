<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 21.06.2016
     * Time: 12:02
     *
     * @var \app\modules\ffClient\models\forms\profile\RegistrationStepOneForm $model
     * @var \yii\web\View $this
     */

    use app\modules\ffClient\Module;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

    $this->title = \Yii::t('profile', 'Quick Registration');
?>

<style>
    .b-registration-holder {
        text-align: center;
    }
</style>

<div class="panel panel-default b-registration-holder">
    <div class="panel-heading">
        <h1>
            <?= $this->title ?> <br>
            <small>
                <?= \Yii::t('profile', 'Just enter your email and you\'re good to go!') ?>
            </small>
        </h1>
    </div>
    <div class="panel-body">
        <?php
            $form = ActiveForm::begin([
                'enableAjaxValidation'   => false,
                'enableClientValidation' => true,
            ]) ?>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <?= $form->field($model, 'email', [
                    'template' => '
                        <div class="input-group">
                          {input}
                          <span class="input-group-btn">                    
                            '.Html::submitButton(\Yii::t('profile', 'Get my address'), [
                            'class' => 'btn btn-primary',
                        ]).'
                          </span>
                        </div>
                        {hint} {error}
                    ',
                ])->textInput([
                    'placeholder' => 'E-mail',
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <?= $form->field($model, 'isAgreementAccepted')->checkbox() ?>
            </div>
        </div>

        <?php ActiveForm::end() ?>
    </div>
</div>