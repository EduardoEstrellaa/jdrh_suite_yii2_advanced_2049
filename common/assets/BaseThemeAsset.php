<?php

namespace common\assets;

use yii\web\AssetBundle;

/**
 * Base theme asset bundle for both frontend and backend.
 */
class BaseThemeAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css',
        'theme/libs/jsvectormap/css/jsvectormap.min.css',
        'theme/css/bootstrap.min.css',
        'theme/libs/swiper/swiper-bundle.min.css',
        'theme/css/icons.min.css',
        'theme/css/app.min.css',
        'theme/css/custom.min.css',
    ];

    public $js = [
        // 1. Bootstrap 5 (base)
        'theme/libs/bootstrap/js/bootstrap.bundle.min.js',

        // 2. Utilidades del tema
        'theme/libs/node-waves/waves.min.js',
        'theme/libs/simplebar/simplebar.min.js',

        // 3. Feather Icons (IMPORTANTE: debe ir ANTES de app.js)
        'theme/libs/feather-icons/feather.min.js',

        // 4. Plugins
        'theme/js/pages/plugins/lord-icon-2.1.0.js',
        'theme/libs/apexcharts/apexcharts.min.js',
        'theme/libs/jsvectormap/js/jsvectormap.min.js',
        'theme/libs/jsvectormap/maps/world-merc.js',
        'theme/libs/swiper/swiper-bundle.min.js',
        'theme/libs/flatpickr/flatpickr.min.js',
        'theme/libs/particles.js/particles.js',

        // 5. Scripts de inicialización (ANTES de app.js)
        'theme/js/plugins.js',
        'theme/js/pages/dashboard-projects.init.js',
        'theme/js/pages/particles.app.js',
        'theme/js/pages/password-addon.init.js',

        // 6. App.js principal (debe ir ÚLTIMO)
        'theme/js/app.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}
