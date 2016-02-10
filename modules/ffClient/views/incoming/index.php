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
        'user_id',
        'outgoing_id',
        'decl_type',
        'create_time:datetime',
        'update_time:datetime',
        'op_notes',
        'hub_id',
        'location',
        [
            'class'   => \yii\grid\Column::className(),
            'header'  => 'Package Img',
            'content' => function ($model, $key, $index) {
                return count($model->packageThumbnails);
            },
        ],
        [
            'class'    => \yii\grid\ActionColumn::className(),
            'template' => '{view} {update}',
            'buttons'  => [
                'view'   => function ($url, $model) {
                    return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',
                        Url::toRoute(['/ffClient/incoming/view', 'id' => $model->id]));
                },
                'update' => function ($url, $model) {
                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>',
                        Url::toRoute(['/ffClient/incoming/update', 'id' => $model->id]));
                },
            ],
        ],
    ],
]); ?>
