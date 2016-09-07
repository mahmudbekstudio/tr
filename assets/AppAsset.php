<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.min.css',
        'font-awesome/css/font-awesome.css',
        'css/plugins/blueimp/css/blueimp-gallery.min.css',
        'css/plugins/iCheck/custom.css',
        'css/animate.css',
        'css/plugins/toastr/toastr.min.css',
        'css/style.css',
        'css/custom.css',
    ];
    public $js = [
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
        'js/scripts.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
