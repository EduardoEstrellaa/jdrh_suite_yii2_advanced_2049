<?php

namespace frontend\services\pdf;

use Yii;

class PdfValueFormatter
{
    // Formatter methods keep the PDF labels consistent even when the source value is empty or invalid.
    public function fmtValue($value, string $fallback = 'No registrado'): string
    {
        return ($value === null || $value === '') ? $fallback : $value;
    }

    public function boolValue($value, string $fallback = 'No registrado'): string
    {
        if ($value === null || $value === '') {
            return $fallback;
        }
        return ((int)$value === 1) ? 'Si' : 'No';
    }

    public function mapValue($id, array $map, string $fallback = 'No registrado'): string
    {
        if ($id === null || $id === '') {
            return $fallback;
        }
        return $map[(int)$id] ?? $fallback;
    }

    public function dateValue($value, string $format = 'php:d/m/Y', string $fallback = 'No registrado'): string
    {
        if (!$value) {
            return $fallback;
        }
        try {
            return Yii::$app->formatter->asDate($value, $format);
        } catch (\Throwable $e) {
            return $fallback;
        }
    }

    public function timeValue($value, string $fallback = 'No registrado'): string
    {
        if (!$value) {
            return $fallback;
        }
        try {
            return Yii::$app->formatter->asTime($value, 'php:h:i a');
        } catch (\Throwable $e) {
            return $fallback;
        }
    }

    public function dateFmtValue($value, string $phpFormat = 'd/m/Y', string $fallback = 'No registrado'): string
    {
        if (!$value) {
            return $fallback;
        }
        try {
            return Yii::$app->formatter->asDate($value, 'php:' . $phpFormat);
        } catch (\Throwable $e) {
            return $fallback;
        }
    }

    public function listByIdsValue(array $ids, array $map, string $fallback = 'No registrado'): string
    {
        $labels = [];
        foreach ($ids as $id) {
            $key = (int)$id;
            if (isset($map[$key])) {
                $labels[] = $map[$key];
            }
        }

        return empty($labels) ? $fallback : implode(', ', $labels);
    }

    public function ageYearsValue($fechaNac): ?int
    {
        if (!$fechaNac) {
            return null;
        }
        try {
            $fn = new \DateTime($fechaNac);
            $hoy = new \DateTime('today');
            return (int)$fn->diff($hoy)->y;
        } catch (\Throwable $e) {
            return null;
        }
    }

    public function firstPropValue($obj, array $props)
    {
        if (!$obj) {
            return null;
        }
        foreach ($props as $p) {
            if (isset($obj->$p) && $obj->$p !== '' && $obj->$p !== null) {
                return $obj->$p;
            }
        }
        return null;
    }

    public static function fmt($value, string $fallback = 'No registrado'): string
    {
        return (new static())->fmtValue($value, $fallback);
    }

    public static function bool($value, string $fallback = 'No registrado'): string
    {
        return (new static())->boolValue($value, $fallback);
    }

    public static function map($id, array $map, string $fallback = 'No registrado'): string
    {
        return (new static())->mapValue($id, $map, $fallback);
    }

    public static function date($value, string $format = 'php:d/m/Y', string $fallback = 'No registrado'): string
    {
        return (new static())->dateValue($value, $format, $fallback);
    }

    public static function time($value, string $fallback = 'No registrado'): string
    {
        return (new static())->timeValue($value, $fallback);
    }

    public static function dateFmt($value, string $phpFormat = 'd/m/Y', string $fallback = 'No registrado'): string
    {
        return (new static())->dateFmtValue($value, $phpFormat, $fallback);
    }

    public static function listByIds(array $ids, array $map, string $fallback = 'No registrado'): string
    {
        return (new static())->listByIdsValue($ids, $map, $fallback);
    }

    public static function ageYears($fechaNac): ?int
    {
        return (new static())->ageYearsValue($fechaNac);
    }

    public static function firstProp($obj, array $props)
    {
        return (new static())->firstPropValue($obj, $props);
    }
}
