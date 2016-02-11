<?php

    /* @var $this \yii\web\View */
    /* @var $content string */

    use app\assets\AppAsset;
    use yii\bootstrap\Nav;
    use yii\bootstrap\NavBar;
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\Breadcrumbs;

    AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
        NavBar::begin([
            'brandLabel' => 'My Company',
            'brandUrl'   => Yii::$app->homeUrl,
            'options'    => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        $items = [];
        if (Yii::$app->user->isGuest) {
            $items[] = ['label' => 'Login', 'url' => ['/site/login']];
            $items[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        } else {
            $items[] = ['label' => 'Users', 'url' => Url::to(['/ffClient/user/index'])];
            $items[] = ['label' => 'Expected Incoming', 'url' => Url::to(['/ffClient/expected-incoming/index'])];
            $items[] = ['label' => 'Incoming', 'url' => Url::to(['/ffClient/incoming/index'])];
            $items[] = ['label' => 'Outgoing', 'url' => Url::to(['/ffClient/outgoing/index'])];
            $items[] = [
                'label'       => 'Logout ('.Yii::$app->user->identity->username.')',
                'url'         => ['/site/logout'],
                'linkOptions' => ['data-method' => 'post'],
            ];
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items'   => $items,
        ]);
        NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

        <?php if ($flashes = Yii::$app->session->getAllFlashes()) {
            foreach ($flashes as $flash) {
                echo "<div class='alert alert-info'>".$flash."</div>";
            }
        } ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
