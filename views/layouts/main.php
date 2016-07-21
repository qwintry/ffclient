<?php

    /* @var $this \yii\web\View */
    /* @var $content string */

    use app\assets\AppAsset;
    use yii\bootstrap\Nav;
    use yii\bootstrap\NavBar;
    use yii\helpers\Html;
    use yii\helpers\Url;

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
    <header>
        <?php
            NavBar::begin([
                'brandLabel' => \Yii::$app->language == 'ru' ? 'Бандеролька' : 'Qwintry',
                'brandUrl'   => \Yii::$app->homeUrl,
                'options'    => [
                    'class' => 'navbar navbar-default',
                ],
            ]);
            $items = [];
            if (\Yii::$app->user->isGuest) {
                $items[] = ['label' => 'Login', 'url' => ['/site/login']];
                $items[] = ['label' => 'Signup', 'url' => ['/profile/registration']];
            } else {
                $items[] = [
                    'label' => '<span class="glyphicon glyphicon-user"></span> '.\Yii::t('app', 'My account'),
                    'url'   => Url::to(['/profile/view']),
                ];
                if (\Yii::$app->user->ffId) {
                    $items[] = [
                        'label' => '<span class="glyphicon glyphicon-log-in"></span> '.\Yii::t('app',
                                'Expected Incoming'),
                        'url'   => Url::to(['/ffClient/expected-incoming/index']),
                    ];
                    $items[] = [
                        'label' => '<span class="glyphicon glyphicon-check"></span> '.\Yii::t('app', 'Incoming'),
                        'url'   => Url::to(['/ffClient/incoming/index']),
                    ];
                    $items[] = [
                        'label' => '<span class="glyphicon glyphicon-new-window"></span> '.\Yii::t('app', 'Outgoing'),
                        'url'   => Url::to(['/ffClient/outgoing/index']),
                    ];
                }
                $items[] = [
                    'label'       => '<span class="glyphicon glyphicon-off"></span> '.\Yii::t('app', 'Logout'),
                    'url'         => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post'],
                ];
            }
            echo Nav::widget([
                'options'      => ['class' => 'navbar-nav navbar-right'],
                'items'        => $items,
                'encodeLabels' => false,
            ]);
            NavBar::end();
        ?>
    </header>

    <div class="container">

        <!--        --><? //= Breadcrumbs::widget([
            //            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            //        ]) ?>

        <!--        --><? //= \yii\bootstrap\Alert::widget(); ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">2010–<?= date('Y') ?> &copy; Qwintry.com — this site is a copyright and trademark of
            Qwintry LLC. </p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
