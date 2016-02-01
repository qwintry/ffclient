<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 22.01.2016
     * Time: 17:21
     *
     * @var \app\models\User $model
     */
?>

<h1>Update user: <?=$model->username?> <small><?=$model->email;?></small></h1>

<?= $this->render('_form', [
    'model' => $model,
])?>