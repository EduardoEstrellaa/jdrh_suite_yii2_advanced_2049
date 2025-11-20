<?php

namespace common\assets;

use yii\web\AssetBundle;

class ExpedienteAsset extends AssetBundle
{
    public $sourcePath = '@common/web/js';

    public $js = [
        'expediente-tutores.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}
