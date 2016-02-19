<?php
    use yii\helpers\Html;
    use yii\helpers\Url;

    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 04.02.2016
     * Time: 14:40
     *
     * @var \yii\data\ArrayDataProvider $provider
     */
    $title = 'Expected Incomings';
    $this->title = $title;
?>

<h1>
    <?= $title ?>
    <?= Html::a('Create', \yii\helpers\Url::to(['/ffClient/expected-incoming/create']), [
        'class' => 'btn btn-success  btn-sm',
    ]) ?>
</h1>

<?= \yii\grid\GridView::widget([
    'dataProvider' => $provider,
    'columns'      => [
        'id',
        'tracking',
        'user_id',
        'shop',
        'decl_type',
        'hub_id',
        'received',
        'user_notes',
        'processed:boolean',
        'create_time:datetime',
        'update_time:datetime',
        [
            'class' => \yii\grid\Column::className(),
            'header' => 'Special Requests',
            'content' => function ($model, $key, $index, $column) {
                return count($model->specRequests);
            },
        ],
        [
            'class' => \yii\grid\Column::className(),
            'header' => 'Declarations',
            'content' => function ($model, $key, $index, $column) {
                return count($model->declaration);
            },
        ],
        [
            'class'    => \yii\grid\ActionColumn::className(),
            'template' => '{view} {update}',
            'buttons'  => [
                'view'   => function ($url, $model) {
                    return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',
                        Url::toRoute(['/ffClient/expected-incoming/view', 'id' => $model->id]));
                },
                'update' => function ($url, $model) {
                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>',
                        Url::toRoute(['/ffClient/expected-incoming/update', 'id' => $model->id]));
                },
            ],
        ],
    ],
]); ?>
