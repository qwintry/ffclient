<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 05.02.2016
     * Time: 16:43
     *
     * @var \yii\base\View $this
     * @var \app\modules\ffClient\models\forms\ExpectedIncomingForm $model
     */

    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

    $title = $model->tracking;
    $this->title = $title;
?>

<h1>
    Update <?= $title ?>
</h1>
<?php
    $form = ActiveForm::begin([
        'id'                     => 'courier-label-form',
        'options'                => ['class' => 'form-horizontal col-md-8'],
        'enableAjaxValidation'   => true,
        'enableClientValidation' => true,
    ]) ?>

<?php foreach ($model->getAttributes() as $attribute => $val): ?>
    <? //TODO:сделать норм?>
    <?= $form->field($model, $attribute); ?>
<?php endforeach; ?>

<div class="form-group">
    <div class="col-lg-11">
        <?= Html::submitButton(\Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        <?= Html::a(\Yii::t('app', 'Cancel'), \yii\helpers\Url::to(['/ffClient/expected-incoming/index']),
            ['class' => 'btn btn-default']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>
