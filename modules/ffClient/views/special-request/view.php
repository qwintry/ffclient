<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 04.02.2016
     * Time: 15:28
     *
     * @var stdClass $model
     * @var \yii\data\ArrayDataProvider $specialRequestsProvider
     * @var \yii\data\ArrayDataProvider $declarationProvider
     */

    use yii\helpers\Html;

    $title = 'Special request  #'.$model->id;
    $this->title = $title;
?>

<h1><?= $title ?>
    <?= Html::a('Edit', \yii\helpers\Url::to(['update', 'id' => $model->id]), [
        'class' => 'btn btn-warning  btn-sm',
    ]) ?>
</h1>

<?= \yii\widgets\DetailView::widget([
    'model'      => $model,
    'attributes' => [
        'customerNotes',
        'type',
        'status',
        'notes',
    ],
]); ?>

    <h2>Attachments:</h2>
    <h3>Customer:</h3>
    <div class="row">
        <?php foreach ($model->customerFilesForApi as $photo): ?>
            <?php if ($photo['base64Extension'] == 'pdf'): ?>
                <div class="col-md-4">
                    <object data="data:application/pdf;base64,<?= $photo['base64Data']?>" type="application/pdf" width="100%" height="200px">
                        <p>Pdf file does not be shown, please download it via link below</p>
                    </object>
                    <a href="data:application/pdf;base64,<?= $photo['base64Data']?>">Download file</a>
                </div>
            <?php else: ?>
                <div class="col-md-4">
                    <?= Html::img("data: image/*;base64,".$photo['base64Data'], [
                        'style' => 'max-height:200px',
                    ]) ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <h3>Operator:</h3>
    <div class="row">
        <?php foreach ($model->operatorFilesForApi as $photo): ?>
            <?php if ($photo['base64Extension'] == 'pdf'): ?>
                <div class="col-md-4">
                    <object data="data:application/pdf;base64,<?= $photo['base64Data']?>" type="application/pdf" width="100%" height="200px">
                        <p>Pdf file does not be shown, please download it via link below</p>
                    </object>
                    <a href="data:application/pdf;base64,<?= $photo['base64Data']?>">Download file</a>
                </div>
            <?php else: ?>
                <div class="col-md-4">
                    <?= Html::img("data: image/*;base64,".$photo['base64Data'], [
                        'style' => 'max-height:200px',
                    ]) ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

<?=Html::a('Back', \yii\helpers\Url::previous(), [
    'class' => 'btn btn-link'
])?>