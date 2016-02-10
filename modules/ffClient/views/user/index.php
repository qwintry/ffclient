<?php
    use yii\bootstrap\Html;
    use yii\grid\GridView;
    use yii\helpers\Url;

    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 22.01.2016
     * Time: 17:05
     *
     * @var \yii\data\ArrayDataProvider $provider
     */

    $title = 'Users';
    $this->title = 'Users';

?>

<h1>
    <?= $title ?>
    <?= Html::a('Create', Url::toRoute(['/ffClient/user/create']), ['class' => 'btn btn-success btn-sm']) ?>
</h1>


<?= GridView::widget([
    'dataProvider' => $provider,
    'columns'      => [
        'id',
        'username',
        'email',
        'created_at:datetime',
        'updated_at:datetime',
        [
            'class'    => \yii\grid\ActionColumn::className(),
            'template' => '{view} {update}',
            //            'buttons'  => [
            //                'view' => function ($url, $model) {
            //                    return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',
            //                        Url::toRoute(['/ffClient/user/view', 'id' => $model->id]));
            //                },
            //                'update' => function ($url, $model) {
            //                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>',
            //                        Url::toRoute(['/ffClient/user/update', 'id' => $model->id]));
            //                },
            //            ],
        ],
    ],
]) ?>
