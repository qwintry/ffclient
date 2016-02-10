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
    $title = $model->tracking;
    $this->title = $title;
?>

    <h1>Incoming: <?= $title ?> #<?= $model->id ?>
        <?= \yii\helpers\Html::a('Update', \yii\helpers\Url::to(['/ffClient/incoming/update', 'id' => $model->id]), [
            'class' => 'btn btn-warning  btn-sm',
        ]) ?>
    </h1>
<?= \yii\widgets\DetailView::widget([
    'model'      => $model,
    'attributes' => [
        'id',
        'tracking',
        'weight',
        'shop',
        'outgoing_id',
        'decl_type',
        'create_time:datetime',
        'update_time:datetime',
        'op_notes',
        'hub_id',
        'location',
        'expected_incoming_id',
        'part_number',
    ],
]); ?>

<?php if ($declarationProvider): ?>
    <h2>Items in declaration:
        <?= \yii\helpers\Html::a('Update', \yii\helpers\Url::to(['/ffClient/incoming/declaration-update', 'id' => $model->id]), [
            'class' => 'btn btn-warning btn-sm',
        ]) ?>
    </h2>
    <?= \yii\grid\GridView::widget([
        'dataProvider' => $declarationProvider,
    ]); ?>
<?php endif; ?>

<?php if ($model->packageThumbnails): ?>
    <h2>Thumbnails:</h2>
    <?php foreach ($model->packageThumbnails as $thumbnail): ?>
        <?= \yii\helpers\Html::img("http://ff.qwintry.loc/file/download?id=".$thumbnail->id); ?>
    <?php endforeach; ?>
<?php endif; ?>


<?php if ($specialRequestsProvider): ?>
    <h2>Special Requests:</h2>
    <?= \yii\grid\GridView::widget([
        'dataProvider' => $specialRequestsProvider,
    ]); ?>
<?php endif; ?>


<?= \yii\helpers\Html::a('List', \yii\helpers\Url::to(['/ffClient/incoming/index']), [
    'class' => 'btn btn-default',
]) ?>