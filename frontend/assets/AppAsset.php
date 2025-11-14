<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css', // Agregar Font Awesome CDN
        'theme/libs/jsvectormap/css/jsvectormap.min.css',
        'theme/css/bootstrap.min.css',
        'theme/libs/swiper/swiper-bundle.min.css',
        'theme/css/icons.min.css',
        'theme/css/app.min.css',
        'theme/css/custom.min.css',
        'css/signup.css',

    ];
    public $js = [

        'theme/libs/bootstrap/js/bootstrap.bundle.min.js',
        'theme/libs/node-waves/waves.min.js',
        'theme/libs/simplebar/simplebar.min.js',
        'theme/libs/feather-icons/feather.min.js',
        'theme/js/pages/plugins/lord-icon-2.1.0.js',
        'theme/libs/apexcharts/apexcharts.min.js',
        'theme/js/plugins.js',
        'theme/js/pages/dashboard-projects.init.js',
        'theme/libs/jsvectormap/js/jsvectormap.min.js',
        'theme/libs/jsvectormap/maps/world-merc.js',
        'theme/libs/swiper/swiper-bundle.min.js',
        'theme/libs/flatpickr/flatpickr.min.js',
        'theme/js/app.js',
        'theme/libs/particles.js/particles.js',
        'theme/js/pages/particles.app.js',
        'theme/js/pages/password-addon.init.js'

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}
