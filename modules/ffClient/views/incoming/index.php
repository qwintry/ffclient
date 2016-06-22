<?php
    use yii\helpers\Html;
    use yii\helpers\Url;

    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 05.02.2016
     * Time: 14:36
     *
     * @var \yii\data\ArrayDataProvider $provider
     * @var \yii\base\View $this
     */

    $title = \Yii::t('app', 'Incomings');
    $this->title = $title;
?>

<h1>
    <?= $title ?>

</h1>

<?= \yii\grid\GridView::widget([
    'dataProvider' => $provider,
    'columns'      => [
        'id',
        'tracking',
        'status',
        'weight',
        'shop',
        //        [
        //            'class'   => \yii\grid\Column::className(),
        //            'header'  => 'User',
        //            'content' => function ($model, $key, $index) {
        //                if ($model->user_id) {
        //                    return Html::a("User #".$model->user_id, Url::to(['user/view-ex', 'id' => $model->user_id]));
        //                }
        //
        //                return null;
        //            },
        //        ],
        [
            'class'   => \yii\grid\Column::className(),
            'header'  => 'Outgoing',
            'content' => function ($model, $key, $index) {
                if ($model->outgoing_id) {
                    return Html::a("Outgoing #".$model->outgoing_id,
                        Url::to(['outgoing/view', 'id' => $model->outgoing_id]));
                }

                return null;
            },
        ],
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
                        Url::to(['special-request/create', 'relatedType' => 'incoming', 'id' => $model->id], [
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
