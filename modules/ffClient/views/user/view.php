<?php

    use \yii\helpers\Url;
    use yii\helpers\Html;
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 26.01.2016
     * Time: 12:46
     *
     * @var \app\modules\ffClient\models\UserForm $model
     */
?>

<?= \yii\widgets\DetailView::widget([
    'model'      => $model,
    'attributes' => array_keys($model->getAttributes()),
]); ?>

<?= Html::a(\Yii::t('app', 'List'), Url::toRoute(['/ffClient/user/index']), ['class' => 'btn btn-default']) ?>
<?= Html::a(\Yii::t('app', 'Update'), Url::toRoute(['/ffClient/user/update', 'id' => $model->id]), ['class' => 'btn btn-warning']) ?>

