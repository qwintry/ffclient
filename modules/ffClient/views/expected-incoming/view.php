<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 04.02.2016
     * Time: 15:28
     *
     * @var stdClass $model
     */

    $title = $model->tracking;
    $this->title = $title;
?>

<h1><?= $title ?></h1>
<?= \yii\widgets\DetailView::widget([
    'model' => $model,
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
        'create_date:datetime',
        'update_date:datetime',
        [
            'class' => \yii\grid\Column::className(),
            'label' => 'Special Requests',
            'value' => $model->specRequest,
        ],
        [
            'class' => \yii\grid\Column::className(),
            'label' => 'Declarations',
            'value' => count($model->declaration),
        ],
    ]
]); ?>
<?= \yii\helpers\Html::a('List', \yii\helpers\Url::to(['/ffClient/expected-incoming/index']), [
    'class' => 'btn btn-default',
]) ?>
<?= \yii\helpers\Html::a('Update', \yii\helpers\Url::to(['/ffClient/expected-incoming/update', 'id' => $model->id]), [
    'class' => 'btn btn-warning',
]) ?>