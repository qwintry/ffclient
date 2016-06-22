<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 21.06.2016
     * Time: 21:44
     * @var \app\models\forms\profile\ActivationForm $model
     */

    use app\modules\ffClient\Module;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

?>

<?php
    $form = ActiveForm::begin([
        'enableAjaxValidation'   => false,
        'enableClientValidation' => true,
    ]) ?>
<?= $form->errorSummary($model) ?>
<div class="row">
    <div class="col-md-12">
        <h3><?= \Yii::t("profile", "Your current password was sent to your email") ?></h3>
        <p><?= \Yii::t("profile", "Activate your account:") ?></p>
        <p><?= \Yii::t("profile", "Enter your name here:") ?></p>
    </div>
</div>
<div class="row">
    <?= $form->field($model, 'firstName', [
        'options'  => [
            'class' => 'col-md-4',
        ],
        'template' => "{input} {error} {hint}",
    ])->textInput([
        'placeholder' => 'John',
    ]) ?>
    <?= $form->field($model, 'lastName', [
        'options'  => [
            'class' => 'col-md-4',
        ],
        'template' => "{input} {error} {hint}",
    ])->textInput([
        'placeholder' => 'Johnson',
    ]) ?>
</div>

<div class="row">
    <div class="col-md-12">
        <p><?= \Yii::t("profile", "We recommend you change your password") ?></p>
    </div>
</div>
<div class="row">
    <?= $form->field($model, 'password', [
        'options'  => [
            'class' => 'col-md-4',
        ],
        'template' => "{input} {error} {hint}",
    ])->passwordInput([
        'placeholder' => \Yii::t('profile', 'New password'),
    ]) ?>
        <div class="col-md-4">
            <?= Html::submitButton(\Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-block']) ?>
        </div>
</div>

<?php ActiveForm::end() ?>
