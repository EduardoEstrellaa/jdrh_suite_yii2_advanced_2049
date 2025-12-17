<?php

namespace common\services\support;

/**
 * Resultado simple para operaciones de aplicaciÇün.
 */
class OperationResult
{
    /** @var bool */
    private $success;

    /** @var string|null */
    private $message;

    private function __construct($success, $message = null)
    {
        $this->success = (bool)$success;
        $this->message = $message;
    }

    public static function ok($message = null)
    {
        return new self(true, $message);
    }

    public static function fail($message = null)
    {
        return new self(false, $message);
    }

    public function isOk()
    {
        return $this->success;
    }

    public function message()
    {
        return $this->message;
    }
}
