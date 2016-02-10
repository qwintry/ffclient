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
    use yii\grid\ActionColumn;
    use yii\grid\GridView;
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\DetailView;

    $title = $model->tracking;
    $this->title = $title;
?>

    <h1>Incoming: <?= $title ?> #<?= $model->id ?>
        <?= Html::a('Edit', \yii\helpers\Url::to(['/ffClient/incoming/update', 'id' => $model->id]), [
            'class' => 'btn btn-warning  btn-sm',
        ]) ?>
    </h1>
<?= DetailView::widget([
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

    <h2>Items in declaration:
        <?= Html::a('Edit', \yii\helpers\Url::to(['/ffClient/incoming/declaration-update', 'id' => $model->id]), [
            'class' => 'btn btn-warning btn-sm',
        ]) ?>
    </h2>
<?= GridView::widget([
    'dataProvider' => $declarationProvider,
    'columns'      => [
        'id',
        'descr',
        'descr_ru',
        'line_value',
        'line_weight',
        'url',
        'qty',
    ],
]); ?>

    <h2>Thumbnails:</h2>
<?php foreach ($model->packageThumbnails as $thumbnail): ?>
    <?= \yii\helpers\Html::img("http://ff.qwintry.loc/file/download?id=".$thumbnail->id); ?>
<?php endforeach; ?>

    <h2>Special Requests:
        <?= Html::a('Create', \yii\helpers\Url::to(['/ffClient/incoming/special-request-create', 'id' => $model->id]), [
            'class' => 'btn btn-success btn-sm',
        ]) ?>
    </h2>
<?= \yii\grid\GridView::widget([
    'dataProvider' => $specialRequestsProvider,
]); ?>


<?= \yii\helpers\Html::a('List', \yii\helpers\Url::to(['/ffClient/incoming/index']), [
    'class' => 'btn btn-default',
]) ?>