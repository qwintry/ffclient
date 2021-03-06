<?php
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
     * @var \app\modules\ffClient\models\forms\IncomingForm $model
     */
?>

<?php
    $form = ActiveForm::begin([
        'id'                     => 'courier-label-form',
        'options'                => ['class' => 'form-horizontal'],
        'enableAjaxValidation'   => true,
        'enableClientValidation' => true,
    ]) ?>
<?= $form->errorSummary($model) ?>

<div class="row">
    <?= $form->field($model, 'tracking', [
        'options' => [
            'class' => 'col-lg-4',
        ],
    ]) ?>
    <?= $form->field($model, 'shop', [
        'options' => [
            'class' => 'col-lg-4',
        ],
    ]) ?>
</div>

<div class="row">
    <?= $form->field($model, 'user_notes', [
        'options' => [
            'class' => 'col-lg-12',
        ],
    ])->textarea() ?>
</div>

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
