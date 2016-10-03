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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?php
    $css = array(
        //'css/bootstrap.min.css',
        'font-awesome/css/font-awesome.css',
        'css/plugins/blueimp/css/blueimp-gallery.min.css',
        'css/plugins/iCheck/custom.css',
        'css/animate.css',
        'css/plugins/toastr/toastr.min.css',
        'css/style.css',
        'css/custom.css',
    );
    $js = array(
        'js/plugins/fullcalendar/moment.min.js',
        //'js/jquery-2.1.1.js',
        'js/jquery-ui-1.10.4.min.js',
        'js/bootstrap.min.js',
        'js/plugins/metisMenu/jquery.metisMenu.js',
        'js/plugins/slimscroll/jquery.slimscroll.min.js',
        'js/jquery.cookie.js',
        'js/jquery-ui.custom.min.js',
        'js/plugins/iCheck/icheck.min.js',
        'js/inspinia.js',
        'js/plugins/pace/pace.min.js',
        'js/jquery-code-scanner.js',
        'js/extends.js',
        'js/scripts.js',
    );
    $baseUrl = Yii::$app->urlManager->baseUrl . '/';

    $cssCount = count($css);
    for($i = 0; $i < $cssCount; $i++) {
        echo "<link href=\"" . $baseUrl . $css[$i] . "\" rel=\"stylesheet\">\n";
    }
    ?>
</head>
<body class="<?php echo (isset($this->params['bodyClass']) ? $this->params['bodyClass'] : ''); ?>">
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
            ['label' => Yii::$app->user->identity->username, 'items' => [
                ['label' => 'Category', 'url' => ['/category']],
                ['label' => 'Posts', 'url' => ['/post']],
                ['label' => 'Comments', 'url' => ['/comment']],
                [
                    'label' => 'Logout',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']]
            ]
            ]
                //'<li>'
                //. Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
                //. Html::submitButton(
                //    'Logout (' . Yii::$app->user->identity->username . ')',
                //    ['class' => 'btn btn-link']
                //)
                //. Html::endForm()
                //. '</li>'
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

<?php $this->endBody();
$jsCount = count($js);
for($i = 0; $i < $jsCount; $i++) {
    echo "<script src=\"" . $baseUrl . $js[$i] . "\"></script>\n";
}
?>
</body>
</html>
<?php $this->endPage() ?>
