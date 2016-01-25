<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 22.01.2016
     * Time: 17:21
     *
     * @var \yii\base\DynamicModel $model
     * @var array $attributes
     */
?>

<h1>Add new user</h1>

<?= $this->render('_form', [
    'model' => $model,
    'attributes' => $attributes,
])?>