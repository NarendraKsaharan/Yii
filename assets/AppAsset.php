<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'theme/assets/css/style.css',
        'https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css',
    ];
    public $js = [
        "theme/assets/vendor/apexcharts/apexcharts.min.js",
        "theme/assets/vendor/bootstrap/js/bootstrap.bundle.min.js",
        "theme/assets/vendor/chart.js/chart.umd.js",
        "theme/assets/vendor/echarts/echarts.min.js",
        "theme/assets/vendor/quill/quill.min.js",
        "theme/assets/vendor/simple-datatables/simple-datatables.js",
        "theme/assets/vendor/tinymce/tinymce.min.js",
        "theme/assets/vendor/php-email-form/validate.js",
        'https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset'
    ];
}
