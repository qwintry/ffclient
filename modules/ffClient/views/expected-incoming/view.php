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

    $title = 'Expected Incoming: '.$model->tracking." #".$model->id;
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
        'id',
        'tracking',
        'user_id',
        'shop',
        'received:boolean',
        'user_notes',
        'processed:boolean',
        'create_time:datetime',
        'update_time:datetime',
    ],
]); ?>



<?= $this->render('@app/modules/ffClient/views/common/declaration-view', [
    'model'         => $model,
    'itemsProvider' => $declarationProvider,
]) ?>

<?= $this->render('@app/modules/ffClient/views/common/special-request-view', [
    'model'                   => $model,
    'specialRequestsProvider' => $specialRequestsProvider,
]) ?>

<?= \yii\helpers\Html::a('List', \yii\helpers\Url::to(['/ffClient/expected-incoming/index']), [
    'class' => 'btn btn-default',
]) ?>