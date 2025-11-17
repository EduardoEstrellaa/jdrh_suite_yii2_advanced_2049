<?php

namespace frontend\assets;

use frontend\assets\AppAsset;

class SignupAsset extends AppAsset
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/signup.css',
    ];

    public $js = [
        'js/signup.js',
    ];

}
