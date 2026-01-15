<?php

namespace backend\forms\reportes;

use yii\base\Model;

/**
 * Clase base para validar y normalizar consultas de reportes.
 */
abstract class BaseReportRequest extends Model
{
    protected const INT_ATTRIBUTES = [];
    protected const BOOL_ATTRIBUTES = [];

    /**
     * Retorna el nombre del formulario en blanco para permitir carga directa.
     */
    public function formName(): string
    {
        return '';
    }

    /**
     * Normaliza y carga los datos entrantes para evitar valores vacios confusos.
     */
    public function load($data, $formName = null): bool
    {
        $formName = $formName ?? $this->formName();
        return parent::load($this->normalizeData($data, $formName), $formName);
    }

    private function normalizeData(array $data, string $formName): array
    {
        if ($formName === '') {
            return $this->normalizeAttributes($this->filterAllowedAttributes($data));
        }

        if (isset($data[$formName]) && is_array($data[$formName])) {
            $data[$formName] = $this->normalizeAttributes($this->filterAllowedAttributes($data[$formName]));
        }

        return $data;
    }

    private function filterAllowedAttributes(array $attributes): array
    {
        $available = array_flip(array_keys(get_object_vars($this)));
        return array_intersect_key($attributes, $available);
    }

    private function normalizeAttributes(array $attributes): array
    {
        foreach (static::INT_ATTRIBUTES as $attribute) {
            if (array_key_exists($attribute, $attributes)) {
                $attributes[$attribute] = $this->normalizeInt($attributes[$attribute]);
            }
        }
        foreach (static::BOOL_ATTRIBUTES as $attribute) {
            if (array_key_exists($attribute, $attributes)) {
                $attributes[$attribute] = $this->normalizeBool($attributes[$attribute]);
            }
        }

        return $attributes;
    }

    protected function normalizeInt(mixed $value): ?int
    {
        if ($value === '' || $value === null) {
            return null;
        }

        return (int)$value;
    }

    protected function normalizeBool(mixed $value): bool
    {
        return (bool)filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }
}
