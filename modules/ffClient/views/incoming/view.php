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
]); ?>

<?= \yii\helpers\Html::a('List', \yii\helpers\Url::to(['/ffClient/incoming/index']), [
    'class' => 'btn btn-default',
]) ?>
<?= \yii\helpers\Html::a('Update', \yii\helpers\Url::to(['/ffClient/incoming/update', 'id' => $model->id]), [
    'class' => 'btn btn-warning',
]) ?>
