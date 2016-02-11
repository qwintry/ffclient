<?php
    use app\modules\ffClient\Module;
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\ActiveForm;

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

    $attributes = Module::$OutgoingForm;
?>

<?php
    $form = ActiveForm::begin([
        'id'                     => 'courier-label-form',
        'options'                => ['class' => 'form-horizontal col-md-8'],
        'enableAjaxValidation'   => true,
        'enableClientValidation' => true,
    ]) ?>

<?= $form->errorSummary($model); ?>

<?= $form->field($model, 'incomingSelected')->checkboxList($incomings); ?>

<?php foreach ($attributes as $attribute): ?>
    <? //TODO:сделать норм?>
    <?php if ('incomingSelected' != $attribute): ?>
        <?= $form->field($model, $attribute); ?>
    <?php endif; ?>
<?php endforeach; ?>

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
