<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 04.03.2016
     * Time: 13:38
     *
     * @var \yii\data\ArrayDataProvider $specialRequestsProvider
     * @var \app\modules\ffClient\models\ApiModel $model
     */
?>


<h2>Special Requests:
    <?= \yii\bootstrap\Html::a('Create', \yii\helpers\Url::to(['special-request-create', 'id' => $model->id]), [
        'class' => 'btn btn-success btn-sm',
    ]) ?>
</h2>
<?= \yii\grid\GridView::widget([
    'dataProvider' => $specialRequestsProvider,
    'columns'      => [
        'customerNotes',
        'type',
        'notes',
        'status',
        [
            'class' => \yii\grid\ActionColumn::className(),
            'template' => '{view} {update} {delete}',
            'buttons' => [
              'view' => function($url, $model) {
                  return \yii\helpers\Html::a('<i class="glyphicon glyphicon-eye-open"></i>', ['special-request/view', 'id' => $model->id]);
              },
              'update' => function($url, $model) {
                  return \yii\helpers\Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['special-request/update', 'id' => $model->id]);
              },
              'delete' => function($url, $model) {
                  return \yii\helpers\Html::a('<i class="glyphicon glyphicon-remove"></i>', ['special-request/delete', 'id' => $model->id]);
              },
            ],
        ]
    ],
]); ?>
