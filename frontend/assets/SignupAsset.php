<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class SignupAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/signup.css',
    ];

    public $js = [
        'js/signup.js',
    ];

    public $depends = [
        'frontend\assets\AppAsset', // Asegurarse que Font Awesome y Bootstrap ya estén cargados
        'yii\web\YiiAsset',
        'kartik\select2\Select2Asset',
    ];
}
