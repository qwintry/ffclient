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
    use yii\helpers\Url;
    use yii\widgets\ActiveForm;

    $title = 'Create new special request';
    $this->title = $title;

?>

<h1><?= $title ?></h1>

<?php
    $form = ActiveForm::begin([
        'id'                     => 'courier-label-form',
        'options'                => ['class' => 'form-horizontal col-md-8'],
        'enableAjaxValidation'   => true,
        'enableClientValidation' => true,
    ]) ?>
<?= $form->errorSummary($model); ?>
<div class="row">
    <?= $form->field($model, 'customerNotes', [
        'options' => [
            'class' => 'col-lg-12',
        ],
    ])->textarea(['row' => 3]) ?>
</div>

<div class="row">
    <?= $form->field($model, 'type', [
        'options' => [
            'class' => 'col-lg-6',
        ],
    ])->dropDownList(Yii::$app->getModule('ffClient')->reference->specialRequestTypes(), [
        'prompt' => '-- Choose request type',
    ]) ?>

</div>


<div class="form-group">
    <div class="col-lg-11">
        <?= Html::submitButton(\Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        <?= Html::a(\Yii::t('app', 'Cancel'), Url::to(['index']), [
            'class' => 'btn btn-link',
        ]); ?>
    </div>
</div>
<?php ActiveForm::end() ?>
