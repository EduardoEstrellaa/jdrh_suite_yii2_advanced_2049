<?php

namespace backend\assets;

use yii\web\AssetBundle;

class PerfilFormAsset extends AssetBundle
{
    public $sourcePath = '@common/web';

    public $css = [
        'css/card-custom.css',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'frontend\assets\AppAsset',
    ];

    public function init()
    {
        parent::init();

        $this->publishOptions = [
            'forceCopy' => YII_DEBUG,
        ];
    }
}
