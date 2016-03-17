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
     * @var \yii\web\View $this
     */

    $title = 'Create new Outgoing';
    $this->title = $title;
?>

<h1><?= $title ?></h1>

<?= $this->render('_form', [
    'model'     => $model,
    'incomings' => $incomings,
]) ?>

<?php $this->registerJs('

    $("#outgoingform-user_id").on("change", function() {
        var user_id = parseInt($(this).val());
        var url = window.location.href;
        console.log(user_id);

        var regex = new RegExp(/\?user_id=(\d+)(&|$)/);
        if(user_id && url.match(regex)) {
            window.location.href = url.replace(regex, "?user_id=" + user_id);
        } else if(user_id) {
            window.location.href = url + "?user_id=" + user_id;
        } else {
            window.location.href = url.replace(regex, "");
        }
    });

', \yii\web\View::POS_READY, 'user-selector') ?>