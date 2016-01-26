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

<?php foreach ($model->getAttributes() as $attribute => $value): ?>
    <?= $form->field($model, $attribute) ?>
<?php endforeach; ?>

<div class="form-group">
    <?= Html::submitButton(\Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
    <?= Html::a(\Yii::t('app', 'Cancel'), Url::toRoute(['/ffClient/user/index']), ['class' => 'btn btn-link']) ?>
</div>
<?php ActiveForm::end() ?>
