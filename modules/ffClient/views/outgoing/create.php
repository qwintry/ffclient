<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 10.02.2016
     * Time: 15:53
     *
     * @var \yii\base\View $this
     * @var \app\modules\ffClient\models\forms\ExpectedIncomingForm $model
     * @var array $incomings
     */

    $title = 'Create new Outgoing';
    $this->title = $title;
?>

<h1><?= $title ?></h1>

<?= $this->render('_form', [
    'model'     => $model,
    'incomings' => $incomings,
]) ?>
