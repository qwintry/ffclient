<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 21.06.2016
     * Time: 15:08
     *
     * @var \app\modules\ffClient\models\User $model
     */

    use yii\helpers\Html;

    $this->title = \Yii::t('profile', 'Profile');
?>
<div class="row">
    <div class="mailbox col-md-5">
        <div class="activate-profile">
            <?php if (isset($model)): ?>
                <?= $this->render("_activation-form", [
                    'model' => $model,
                ]) ?>
            <?php else: ?>
                <?= $this->render("_profile-view") ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-6 col-md-offset-1">
        <div class="balance">
            <h3>
                <?= Html::a(\Yii::t('profile', 'Balance'), '#') ?> - <b>$3</b>
                <?= \yii\helpers\Html::a('<i class="glyphicon glyphicon-plus-sign"></i>&nbsp;'.\Yii::t('profile',
                        'Add to balance'), ['#'], [
                    'class' => 'btn btn-success btn-sm',
                ]) ?>
            </h3>

            <div class="alert alert-danger">
                <?= \Yii::t('profile', 'Attention! Qwintry accepts any payments only through this website!') ?>
            </div>
        </div>
        <div class="invite">
            <h3>
                <?= Html::a(\Yii::t('profile', 'Invite friends and earn cash!'), '#') ?>
                <small>($0)</small>
                <br>
                <small>Партнерская программа Бандерольки: у вас 0 рефералов</small>
            </h3>
        </div>
        <div class="edit">
            <h3>
                <?= Html::a(\Yii::t('profile', 'Change profile details'), '#') ?><br>
            </h3>
        </div>

        <div class="shophelp">
            <h3>
                <?= Html::a(\Yii::t('profile', 'Shopping Help'), '#') ?><small>(0)</small>
            </h3>
        </div>
    </div>
</div>