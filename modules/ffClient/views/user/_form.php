<?php

    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\ActiveForm;

    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 25.01.2016
     * Time: 12:09
     *
     * @var array $attributes
     * @var \app\models\User $model
     */

?>

<?php
    /**
     * @var \yii\widgets\ActiveForm $form
     */
    $form = ActiveForm::begin([
        'id'                     => 'courier-label-form',
        'options'                => ['class' => 'form-horizontal col-md-8'],
        'enableAjaxValidation'   => false,
        'enableClientValidation' => false,
    ]) ?>

<?= $form->field($model, 'first_name') ?>
<?= $form->field($model, 'last_name') ?>
<?= $form->field($model, 'email') ?>
<?= $form->field($model, 'ff_id') ?>
<?= $form->field($model, 'password')->passwordInput() ?>

<div class="form-group">
    <?= Html::submitButton(\Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
    <?= Html::a(\Yii::t('app', 'Cancel'), Url::toRoute(['/ffClient/user/index']), ['class' => 'btn btn-link']) ?>
</div>
<?php ActiveForm::end() ?>
