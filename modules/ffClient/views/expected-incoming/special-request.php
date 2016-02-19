<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 10.02.2016
     * Time: 15:15
     *
     * @var \app\modules\ffClient\models\forms\SpecialRequestForm $model
     */

    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\helpers\Url;
    use app\modules\ffClient\Module;

    $title = 'Create new special request';
    $this->title = $title;
?>

<h1><?=$title?></h1>

<?php
    $form = ActiveForm::begin([
        'id'                     => 'courier-label-form',
        'options'                => ['class' => 'form-horizontal col-md-8'],
        'enableAjaxValidation'   => true,
        'enableClientValidation' => true,
    ]) ?>

<?php foreach (Module::$SpecialRequestForm as $attribute): ?>
    <? //TODO:сделать норм?>
    <?= $form->field($model, $attribute); ?>
<?php endforeach; ?>

<div class="form-group">
    <div class="col-lg-11">
        <?= Html::submitButton(\Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        <?= Html::a(\Yii::t('app', 'Cancel'), Url::to(['index']), [
            'class' => 'btn btn-link'
        ]); ?>
    </div>
</div>
<?php ActiveForm::end() ?>
