<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <link href="<?php echo Yii::$app->urlManager->baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo Yii::$app->urlManager->baseUrl; ?>/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo Yii::$app->urlManager->baseUrl; ?>/css/plugins/blueimp/css/blueimp-gallery.min.css" rel="stylesheet">
    <link href="<?php echo Yii::$app->urlManager->baseUrl; ?>/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="<?php echo Yii::$app->urlManager->baseUrl; ?>/css/animate.css" rel="stylesheet">
    <link href="<?php echo Yii::$app->urlManager->baseUrl; ?>/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="<?php echo Yii::$app->urlManager->baseUrl; ?>/css/style.css" rel="stylesheet">
    <link href="<?php echo Yii::$app->urlManager->baseUrl; ?>/css/custom.css" rel="stylesheet">
</head>
<body class="<?php echo $this->params['bodyClass']; ?>">
<?php $this->beginBody() ?>

<?= $content ?>
<?php /*<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>*/ ?>

<?php $this->endBody() ?>
<!-- Mainly scripts -->
<script src="<?php echo Yii::$app->urlManager->baseUrl; ?>/js/plugins/fullcalendar/moment.min.js"></script>
<!--script src="<?php echo Yii::$app->urlManager->baseUrl; ?>/js/jquery-2.1.1.js"></script-->
<script src="<?php echo Yii::$app->urlManager->baseUrl; ?>/js/jquery-ui-1.10.4.min.js"></script>
<script src="<?php echo Yii::$app->urlManager->baseUrl; ?>/js/bootstrap.min.js"></script>
<script src="<?php echo Yii::$app->urlManager->baseUrl; ?>/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo Yii::$app->urlManager->baseUrl; ?>/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- jQuery UI custom -->
<script src="<?php echo Yii::$app->urlManager->baseUrl; ?>/js/jquery-ui.custom.min.js"></script>

<!-- iCheck -->
<script src="<?php echo Yii::$app->urlManager->baseUrl; ?>/js/plugins/iCheck/icheck.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="<?php echo Yii::$app->urlManager->baseUrl; ?>/js/inspinia.js"></script>
<script src="<?php echo Yii::$app->urlManager->baseUrl; ?>/js/plugins/pace/pace.min.js"></script>
<script src="<?php echo Yii::$app->urlManager->baseUrl; ?>/js/scripts.js"></script>
</body>
</html>
<?php $this->endPage() ?>