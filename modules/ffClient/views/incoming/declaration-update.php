<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 10.02.2016
     * Time: 12:08
     *
     * @var \app\modules\ffClient\models\ApiModel[] $models
     * @var \app\modules\ffClient\models\ApiModel $newModel
     */

    use yii\helpers\ArrayHelper;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

    $title = 'Edit declaration';
    $this->title = $title;
?>
<h1><?= $title ?></h1>
<?php
    $form = ActiveForm::begin([
        'id'                     => 'courier-label-form',
        'options'                => ['class' => 'form-horizontal'],
        'enableAjaxValidation'   => true,
        'enableClientValidation' => true,
    ]);
?>

<?php $i = 0; ?>
<?php foreach ($models as $model): ?>
    <?php if (isset($model->id)): ?>
        <h3>Edit item #<?= $model->id ?></h3>
    <?php else: ?>
        <h3>Add new item</h3>
    <?php endif; ?>
    <div class="row">
        <?= $form->field($model, 'descr', [
            'inputOptions' => [
                'name'  => 'DeclarationForm['.$i.'][descr]',
                'class' => 'form-control',
            ],
            'options' => [
                'class' => ' col-lg-6'
            ]
        ])->textarea() ?>
        <?= $form->field($model, 'descr_ru', [
            'inputOptions' => [
                'name'  => 'DeclarationForm['.$i.'][descr_ru]',
                'class' => 'form-control',
            ],
            'options' => [
                'class' => ' col-lg-6'
            ]
        ])->textarea() ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'line_value', [
            'inputOptions' => [
                'name'  => 'DeclarationForm['.$i.'][line_value]',
                'class' => 'form-control',
            ],
            'options' => [
                'class' => ' col-lg-3'
            ]
        ]) ?>
        <?= $form->field($model, 'line_weight', [
            'inputOptions' => [
                'name'  => 'DeclarationForm['.$i.'][line_weight]',
                'class' => 'form-control',
            ],
            'options' => [
                'class' => ' col-lg-3'
            ]
        ]) ?>
        <?= $form->field($model, 'url', [
            'inputOptions' => [
                'name'  => 'DeclarationForm['.$i.'][url]',
                'class' => 'form-control',
            ],
            'options' => [
                'class' => ' col-lg-3'
            ]
        ]) ?>

        <?= $form->field($model, 'qty', [
            'inputOptions' => [
                'name'  => 'DeclarationForm['.$i.'][qty]',
                'class' => 'form-control',
            ],
            'options' => [
                'class' => ' col-lg-3'
            ]
        ]) ?>
    </div>
    <?php $i++; ?>
    <hr>
<?php endforeach; ?>

<div class="form-group">
    <div class="col-lg-11">
        <?= Html::submitButton(\Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        <?= \yii\helpers\Html::a('Cancel', \yii\helpers\Url::to(['/ffClient/incoming/index']), [
            'class' => 'btn btn-link',
        ]) ?>
    </div>
</div>
<?php ActiveForm::end() ?>
