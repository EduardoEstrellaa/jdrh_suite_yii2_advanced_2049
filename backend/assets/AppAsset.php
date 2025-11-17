<?php

namespace backend\assets;

use common\assets\BaseThemeAsset;

/**
 * Backend application asset bundle.
 */
class AppAsset extends BaseThemeAsset
{
    public function init()
    {
        parent::init();

        // Agregar CSS específico de backend si es necesario
        // $this->css[] = 'css/backend-specific.css';

        // Agregar JS específico de backend si es necesario
        // $this->js[] = 'js/backend-specific.js';
    }
}
