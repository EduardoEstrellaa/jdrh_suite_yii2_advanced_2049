<?php

namespace common\helpers;

class BooleanHelper
{
    public static function options()
    {
        return [
            1 => 'Sí',
            0 => 'No',
        ];
    }

    public static function asText($value)
    {
        return $value ? 'Sí' : 'No';
    }
}
