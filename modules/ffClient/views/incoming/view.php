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
     * @var \yii\web\View $this
     */
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
        'create_time:datetime',
        'update_time:datetime',
        [
            'attribute' => 'expected_incoming',
            'format'    => 'raw',
            'value'     => $model->expected_incoming_id ? Html::a("Expected Incoming #".$model->expected_incoming_id,
                Url::to(['expected-incoming/view', 'id' => $model->expected_incoming_id])) : null,
        ],
    ],
]); ?>

<?= $this->render('@app/modules/ffClient/views/common/declaration-view', [
    'model'         => $model,
    'itemsProvider' => $declarationProvider,
]) ?>

    <h2>Thumbnails:</h2>
<?php foreach ($model->packageThumbnails as $thumbnail): ?>
    <?= \yii\helpers\Html::img("http://ff.qwintry.loc/file/download?id=".$thumbnail->id); ?>
<?php endforeach; ?>

<?= $this->render('@app/modules/ffClient/views/common/special-request-view', [
    'model'                   => $model,
    'specialRequestsProvider' => $specialRequestsProvider,
]) ?>


<?= \yii\helpers\Html::a('Back', \yii\helpers\Url::to(['/ffClient/incoming/index']), [
    'class' => 'btn btn-link',
]) ?>