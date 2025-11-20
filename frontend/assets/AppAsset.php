<?php

namespace frontend\assets;

use common\assets\BaseThemeAsset;

/**
 * Frontend application asset bundle.
 */
class AppAsset extends BaseThemeAsset
{
    public function init()
    {
        parent::init();

        // Agregar CSS específico de frontend (se añade al array existente)
        //$this->css[] = 'css/signup.css';

        // Si necesitas agregar JS específico de frontend:
        // $this->js[] = 'js/frontend-specific.js';
    }
}
