<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 10.02.2016
     * Time: 10:58
     *
     * @var \yii\base\View $this
     * @var \app\modules\ffClient\models\forms\IncomingForm $model
     */

    $title = 'Update '.$model->tracking.' #'.$model->id;
    $this->title = $title;
?>

<h1><?= $title ?></h1>
<?= $this->render('_form', [
    'model' => $model,
]) ?>

