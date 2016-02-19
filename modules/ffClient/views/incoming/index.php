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

    $title = 'Incomings';
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
        'location',
        [
            'class'    => \yii\grid\ActionColumn::className(),
            'template' => '{view} {items}',
            'buttons'  => [
                'view'  => function ($url, $model) {
                    return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',
                        Url::toRoute(['view', 'id' => $model->id]));
                },
                'items' => function ($url, $model) {
                    return Html::a('<i class="glyphicon glyphicon-list"></i>',
                        Url::toRoute(['declaration-update', 'id' => $model->id]));
                },
                //                'update' => function ($url, $model) {
                //                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>',
                //                        Url::toRoute(['/ffClient/incoming/update', 'id' => $model->id]));
                //                },
            ],
        ],
    ],
]); ?>
