<?php

use Illuminate\Support\Facades\Log;


/**
 * Verifica que no exista la funcion global info_ y si es asi la crea
 */
if (!function_exists('info_')) {
    /**
     * Genera un log de tipo info
     *
     * @param string $message
     * @param array $context
     * @return void
     * @author Ing. Benjamín Olvera Rosales
     */
    function info_($message = '', array $context = []): void
    {
        Log::info($message, $context);
    }
}

/**
 * Verifica que no exista la funcion global debug_ y si es asi la crea
 */
if (!function_exists('debug_')) {
    /**
     * Genera un log de tipo debug
     *
     * @param string $message
     * @param array $context
     * @return void
     * @author Ing. Benjamín Olvera Rosales
     */
    function debug_(string $message = '', array $context = []) : void
    {
        Log::debug($message, $context);
    }
}

/**
 * Verifica que no exista la funcion global error_ y si es asi la crea
 */
if (!function_exists('error_')) {
    /**
     * Genera un log de tipo error
     *
     * @param string $message
     * @param array $context
     * @return void
     * @author Ing. Benjamín Olvera Rosales
     */
    function error_(string $message = '', array $context = []) : void
    {
        Log::error($message, $context);
    }
}

/**
 * Verifica que no exista la funcion global alert_ y si es asi la crea
 */
if (!function_exists('alert_')) {
    /**
     * Genera un log de tipo alert
     *
     * @param string $message
     * @param array $context
     * @return void
     * @author Ing. Benjamín Olvera Rosales
     */
    function alert_(string $message = '', array $context = []) : void
    {
        Log::alert($message, $context);
    }
}

/**
 * Verifica que no exista la funcion global critical_ y si es asi la crea
 */
if (!function_exists('critical_')) {
    /**
     * Genera un log de tipo critical
     *
     * @param string $message
     * @param array $context
     * @return void
     * @author Ing. Benjamín Olvera Rosales
     */
    function critical_(string $message = '', array $context = []) : void
    {
        Log::critical($message, $context);
    }
}

/**
 * Verifica que no exista la funcion global emergency_ y si es asi la crea
 */
if (!function_exists('emergency_')) {
    /**
     * Genera un log de tipo emergency
     *
     * @param string $message
     * @param array $context
     * @return void
     * @author Ing. Benjamín Olvera Rosales
     */
    function emergency_(string $message = '', array $context = []) : void
    {
        Log::emergency($message, $context);
    }
}

/**
 * Verifica que no exista la funcion global notice_ y si es asi la crea
 */
if (!function_exists('notice_')) {
    /**
     * Genera un log de tipo notice
     *
     * @param string $message
     * @param array $context
     * @return void
     * @author Ing. Benjamín Olvera Rosales
     */
    function notice_(string $message = '', array $context = []) : void
    {
        Log::notice($message, $context);
    }
}

/**
 * Verifica que no exista la funcion global warning_ y si es asi la crea
 */
if (!function_exists('warning_')) {
    /**
     * Genera un log de tipo warning
     *
     * @param string $message
     * @param array $context
     * @return void
     * @author Ing. Benjamín Olvera Rosales
     */
    function warning_(string $message = '', array $context = []) : void
    {
        Log::warning($message, $context);
    }
}
