<?php
    /**
     * Created by PhpStorm.
     * User: Cranky4
     * Date: 21.06.2016
     * Time: 14:56
     *
     * @var \app\modules\ffClient\models\forms\profile\RegistrationStepOneForm $model
     */

?>

<h1>Учетную запись на Qwintry.com!</h1>
<br>
<p>Ваши авторизационные данные:</p>
<p>Логин: <b><?=$email?></b></p>
<p>Пароль: <b><?=$password?></b></p>
<br>
<p>Вы можете войти на сайт <?=\yii\helpers\Html::a("здесь", \yii\helpers\Url::to('/site/login', true))?>.</p>
<br>
<p>Кстати, у нас есть приложение для iPhone/iPad!</p>
