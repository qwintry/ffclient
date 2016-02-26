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
    use yii\grid\GridView;
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\DetailView;

    $title = $model->tracking;
    $this->title = $title;
?>

    <h1>Incoming: <?= $title ?> #<?= $model->id ?></h1>
<?= \yii\helpers\Html::a('Back', \yii\helpers\Url::to(['/ffClient/incoming/index']), [
    'class' => 'btn btn-link',
]) ?>
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
        [
            'attribute' => 'expected_incoming',
            'format'    => 'raw',
            'value'     => $model->expected_incoming_id ? Html::a("Expected Incoming #".$model->expected_incoming_id,
                Url::to(['expected-incoming/view', 'id' => $model->expected_incoming_id])) : null,
        ],
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
        <?= Html::a('Create', \yii\helpers\Url::to(['special-request-create', 'id' => $model->id]), [
            'class' => 'btn btn-success btn-sm',
        ]) ?>
    </h2>
<?= \yii\grid\GridView::widget([
    'dataProvider' => $specialRequestsProvider,
    'columns'      => [
        'customer_notes',
        'type',
        'status',
        'notes',
        'handling:boolean',
        'charge',
        [
            'class'     => \yii\grid\DataColumn::className(),
            'attribute' => 'authorId',
            'content'   => function ($model, $key, $index) {
                if ($model->authorId) {
                    return Html::a("User #".$model->authorId, Url::to(['user/view', 'id' => $model->authorId]));
                }

                return null;
            },
        ],
        'hub_id',
        'create_time:datetime',
        'update_time:datetime',
    ],
]); ?>


<?= \yii\helpers\Html::a('Back', \yii\helpers\Url::to(['/ffClient/incoming/index']), [
    'class' => 'btn btn-link',
]) ?>