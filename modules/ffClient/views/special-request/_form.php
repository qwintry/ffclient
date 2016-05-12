<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 12.05.2016
     * Time: 10:32
     *
     * @var \yii\web\View $this
     * @var \app\modules\ffClient\models\forms\SpecialRequestForm $model
     */

    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\ActiveForm;

?>

<?php
    $form = ActiveForm::begin([
        'id'                     => 'courier-label-form',
        'options'                => [
            'enctype' => 'multipart/form-data',
        ],
        'enableAjaxValidation'   => false,
        'enableClientValidation' => false,
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

        <?= $form->field($model, 'customerFiles[]', [
            'options' => [
                'class' => 'col-lg-6',
            ],
        ])->fileInput(['multiple' => true, 'class' => 'btn btn-default btn-lg'])->label('Add attachments') ?>
    </div>

    <div class="form-group">
        <div class="col-lg-11">
            <?= Html::submitButton(\Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
            <?= Html::a(\Yii::t('app', 'Cancel'), Url::previous(), [
                'class' => 'btn btn-link',
            ]); ?>
        </div>
    </div>
<?php ActiveForm::end() ?>