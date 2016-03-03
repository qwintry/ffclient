<?php
    /**
     * @var array $declaration
     * @var \yii\data\ArrayDataProvider $itemsProvider
     */
?>

    <h2>Declaration:</h2>
<?php if ($declaration): ?>
    <?= \yii\widgets\DetailView::widget([
        'model'      => $declaration,
        'attributes' => [
            'country',
            'method',
            'weight',
            'value',
        ],
    ]); ?>
<?php endif; ?>

    <h2>Items:
        <?= \yii\helpers\Html::a('Edit',
            \yii\helpers\Url::to(['/ffClient/incoming/declaration-update', 'id' => $model->id]), [
                'class' => 'btn btn-warning btn-sm',
            ]) ?>
    </h2>
<?= \yii\grid\GridView::widget([
    'dataProvider' => $itemsProvider,
    'columns'      => [
        'id',
        'descr',
        'descrLocal',
        'totalValue',
        'totalWeight',
        'url',
        'quantity',
    ],
]); ?>