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
        'status',
        'handling:boolean',
        'createTime:datetime',
        'updateTime:datetime',
    ],
]); ?>
