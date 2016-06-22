<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 21.06.2016
     * Time: 21:48
     *
     * @var \app\modules\ffClient\models\User $model
     * @var \yii\web\View $this
     */

    use app\modules\ffClient\Module;

    $model = \Yii::$app->user->identity;
?>


<h3><?= \Yii::t('profile', 'Your US address in Delaware:') ?></h3>
<p><?= $model->username ?><br>
    825 Dawson Dr <br>
    Qwintry Suite 12-<?= $model->id ?> <br>
    Newark, DE 19712-0825 <br>
    Phone 858-633-6353</p>
