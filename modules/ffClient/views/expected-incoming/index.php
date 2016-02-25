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
        [
            'class'   => \yii\grid\Column::className(),
            'header'  => 'User',
            'content' => function ($model, $key, $index) {
                if ($model->user_id) {
                    return Html::a("User #".$model->user_id, Url::to(['user/view-ex', 'id' => $model->user_id]));
                }

                return null;
            },
        ],
        'shop',
        'decl_type',
        'received:boolean',
        'processed:boolean',
        'create_time:datetime',
        'update_time:datetime',
        [
            'class'    => \yii\grid\ActionColumn::className(),
            'template' => '{view} {update} {declaration} {specRequest}',
            'buttons'  => [
                'view'        => function ($url, $model) {
                    return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',
                        Url::to(['view', 'id' => $model->id]), [
                            'title' => 'View',
                        ]);
                },
                'update'      => function ($url, $model) {
                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>',
                        Url::to(['update', 'id' => $model->id]), [
                            'title' => 'Edit',
                        ]);
                },
                'specRequest' => function ($url, $model) {
                    return Html::a('<i class="glyphicon glyphicon-plus-sign"></i>',
                        Url::to(['special-request-create', 'id' => $model->id], [
                            'class' => 'btn btn-link',
                        ]), [
                            'title' => 'Add special request',
                        ]);
                },
                'declaration' => function ($url, $model) {
                    return Html::a('<i class="glyphicon glyphicon-list-alt"></i>',
                        Url::to(['declaration-update', 'id' => $model->id], [
                            'class' => 'btn btn-link',
                        ]), [
                            'title' => 'View declaration',
                        ]);
                },
            ],
        ],
    ],
]); ?>
