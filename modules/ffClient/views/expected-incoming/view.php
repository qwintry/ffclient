<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 04.02.2016
     * Time: 15:28
     *
     * @var stdClass $model
     * @var \yii\data\ArrayDataProvider $specialRequestsProvider
     */

    use yii\helpers\Html;
    use yii\helpers\Url;

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
        'decl_type',
        'hub_id',
        'received',
        'user_notes',
        'processed',
        'create_time:datetime',
        'update_time:datetime',
        //        [
        //            'class' => \yii\grid\Column::className(),
        //            'label' => 'Declarations',
        //            'value' => count($model->declaration),
        //        ],
    ],
]); ?>

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

<?= \yii\helpers\Html::a('List', \yii\helpers\Url::to(['/ffClient/expected-incoming/index']), [
    'class' => 'btn btn-default',
]) ?>
<?= \yii\helpers\Html::a('Update', \yii\helpers\Url::to(['/ffClient/expected-incoming/update', 'id' => $model->id]), [
    'class' => 'btn btn-warning',
]) ?>