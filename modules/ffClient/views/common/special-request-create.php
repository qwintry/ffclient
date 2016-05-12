<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 10.02.2016
     * Time: 15:15
     *
     * @var \app\modules\ffClient\models\forms\SpecialRequestForm $model
     */

    $title = 'Create new special request';
    $this->title = $title;

?>

<h1><?= $title ?></h1>

<?= $this->render('@app/modules/ffClient/views/special-request/_form', [
    'model' => $model,
]) ?>
