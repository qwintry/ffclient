<?php

    use yii\widgets\ActiveForm;
    use \yii\helpers\Html;

    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 25.01.2016
     * Time: 12:09
     *
     * @var array $attributes
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

<?php foreach ($attributes as $attribute): ?>
    <?= $form->field($model, $attribute) ?>
<?php endforeach; ?>

<div class="form-group">
    <div class="col-lg-11">
        <?= Html::submitButton(\Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>
