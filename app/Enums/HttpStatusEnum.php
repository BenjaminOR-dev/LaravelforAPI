<?php

namespace App\Enums;

use App\Helpers\VarHelper;

class HttpStatusEnum
{
    // 1xx - Informational
    const CONTINUE            = 100;
    const SWITCHING_PROTOCOLS = 101;
    const PROCESSING          = 102; // RFC2518
    const EARLY_HINTS         = 103; // RFC8297

    // 2xx - Succesful
    const OK                            = 200;
    const CREATED                       = 201;
    const ACCEPTED                      = 202;
    const NON_AUTHORITATIVE_INFORMATION = 203;
    const NO_CONTENT                    = 204;
    const RESET_CONTENT                 = 205;
    const PARTIAL_CONTENT               = 206;
    const MULTI_STATUS                  = 207; // RFC4918
    const ALREADY_REPORTED              = 208; // RFC5842
    const IM_USED                       = 226; // RFC3229

    // 3xx - Redirection
    const MULTIPLE_CHOICES      = 300;
    const MOVED_PERMANENTLY     = 301;
    const FOUND                 = 302;
    const SEE_OTHER             = 303;
    const NOT_MODIFIED          = 304;
    const USE_PROXY             = 305;
    const RESERVED              = 306;
    const TEMPORARY_REDIRECT    = 307;
    const PERMANENTLY_REDIRECT  = 308; // RFC7238
    const TOO_MANY_REDIRECTS    = 310; // RFC6842

    // 4xx - Client Error
    const BAD_REQUEST                     = 400;
    const UNAUTHORIZED                    = 401;
    const PAYMENT_REQUIRED                = 402;
    const FORBIDDEN                       = 403;
    const NOT_FOUND                       = 404;
    const METHOD_NOT_ALLOWED              = 405;
    const NOT_ACCEPTABLE                  = 406;
    const PROXY_AUTHENTICATION_REQUIRED   = 407;
    const REQUEST_TIMEOUT                 = 408;
    const CONFLICT                        = 409;
    const GONE                            = 410;
    const LENGTH_REQUIRED                 = 411;
    const PRECONDITION_FAILED             = 412;
    const PAYLOAD_TOO_LARGE               = 413;
    const URI_TOO_LONG                    = 414;
    const UNSUPPORTED_MEDIA_TYPE          = 415;
    const RANGE_NOT_SATISFIABLE           = 416;
    const EXPECTATION_FAILED              = 417;
    const IM_A_TEAPOT                     = 418;
    const MISDIRECTED_REQUEST             = 421;
    const UNPROCESSABLE_ENTITY            = 422;
    const LOCKED                          = 423;
    const FAILED_DEPENDENCY               = 424;
    const TOO_EARLY                       = 425;
    const UPGRADE_REQUIRED                = 426;
    const PRECONDITION_REQUIRED           = 428;
    const TOO_MANY_REQUESTS               = 429;
    const REQUEST_HEADER_FIELDS_TOO_LARGE = 431;
    const UNAVAILABLE_FOR_LEGAL_REASONS   = 451;

    // 5xx - Server Error
    const INTERNAL_SERVER_ERROR           = 500;
    const NOT_IMPLEMENTED                 = 501;
    const BAD_GATEWAY                     = 502;
    const SERVICE_UNAVAILABLE             = 503;
    const GATEWAY_TIMEOUT                 = 504;
    const HTTP_VERSION_NOT_SUPPORTED      = 505;
    const VARIANT_ALSO_NEGOTIATES         = 506;
    const INSUFFICIENT_STORAGE            = 507;
    const LOOP_DETECTED                   = 508;
    const NOT_EXTENDED                    = 510;
    const NETWORK_AUTHENTICATION_REQUIRED = 511;

    /**
     * Obtiene todas las constantes en una colección
     *
     * @return \Illuminate\Support\Collection<object...|empty>
     */
    public static function getCollection()
    {
        $constants = VarHelper::newArrayOfObjects([
            [
                'key' => self::CONTINUE,
                'value'   => 'CONTINUE',
            ],
            [
                'key' => self::SWITCHING_PROTOCOLS,
                'value'   => 'SWITCHING PROTOCOLS',
            ],
            [
                'key' => self::PROCESSING,
                'value'   => 'PROCESSING',
            ],
            [
                'key' => self::EARLY_HINTS,
                'value'   => 'EARLY HINTS',
            ],
            [
                'key' => self::OK,
                'value'   => 'OK',
            ],
            [
                'key' => self::CREATED,
                'value'   => 'CREATED',
            ],
            [
                'key' => self::ACCEPTED,
                'value'   => 'ACCEPTED',
            ],
            [
                'key' => self::NON_AUTHORITATIVE_INFORMATION,
                'value'   => 'NON AUTHORITATIVE INFORMATION',
            ],
            [
                'key' => self::NO_CONTENT,
                'value'   => 'NO CONTENT',
            ],
            [
                'key' => self::RESET_CONTENT,
                'value'   => 'RESET CONTENT',
            ],
            [
                'key' => self::PARTIAL_CONTENT,
                'value'   => 'PARTIAL CONTENT',
            ],
            [
                'key' => self::MULTI_STATUS,
                'value'   => 'MULTI STATUS',
            ],
            [
                'key' => self::ALREADY_REPORTED,
                'value'   => 'ALREADY REPORTED',
            ],
            [
                'key' => self::IM_USED,
                'value'   => 'IM USED',
            ],
            [
                'key' => self::MULTIPLE_CHOICES,
                'value'   => 'MULTIPLE CHOICES',
            ],
            [
                'key' => self::MOVED_PERMANENTLY,
                'value'   => 'MOVED PERMANENTLY',
            ],
            [
                'key' => self::FOUND,
                'value'   => 'FOUND',
            ],
            [
                'key' => self::SEE_OTHER,
                'value'   => 'SEE OTHER'
            ],
            [
                'key' => self::NOT_MODIFIED,
                'value'   => 'NOT MODIFIED',
            ],
            [
                'key' => self::USE_PROXY,
                'value'   => 'USE PROXY',
            ],
            [
                'key' => self::RESERVED,
                'value'   => 'RESERVED',
            ],
            [
                'key' => self::TEMPORARY_REDIRECT,
                'value'   => 'TEMPORARY REDIRECT',
            ],
            [
                'key' => self::PERMANENTLY_REDIRECT,
                'value'   => 'PERMANENTLY REDIRECT',
            ],
            [
                'key' => self::TOO_MANY_REDIRECTS,
                'value'   => 'TOO MANY REDIRECTS',
            ],
            [
                'key' => self::BAD_REQUEST,
                'value'   => 'BAD REQUEST',
            ],
            [
                'key' => self::UNAUTHORIZED,
                'value'   => 'UNAUTHORIZED',
            ],
            [
                'key' => self::PAYMENT_REQUIRED,
                'value'   => 'PAYMENT REQUIRED',
            ],
            [
                'key' => self::FORBIDDEN,
                'value'   => 'FORBIDDEN',
            ],
            [
                'key' => self::NOT_FOUND,
                'value'   => 'NOT FOUND',
            ],
            [
                'key' => self::METHOD_NOT_ALLOWED,
                'value'   => 'METHOD NOT ALLOWED',
            ],
            [
                'key' => self::NOT_ACCEPTABLE,
                'value'   => 'NOT ACCEPTABLE',
            ],
            [
                'key' => self::PROXY_AUTHENTICATION_REQUIRED,
                'value'   => 'PROXY AUTHENTICATION REQUIRED',
            ],
            [
                'key' => self::REQUEST_TIMEOUT,
                'value'   => 'REQUEST TIMEOUT',
            ],
            [
                'key' => self::CONFLICT,
                'value'   => 'CONFLICT',
            ],
            [
                'key' => self::GONE,
                'value'   => 'GONE',
            ],
            [
                'key' => self::LENGTH_REQUIRED,
                'value'   => 'LENGTH REQUIRED',
            ],
            [
                'key' => self::PRECONDITION_FAILED,
                'value'   => 'PRECONDITION FAILED',
            ],
            [
                'key' => self::PAYLOAD_TOO_LARGE,
                'value'   => 'PAYLOAD TOO LARGE',
            ],
            [
                'key' => self::URI_TOO_LONG,
                'value'   => 'URI TOO LONG',
            ],
            [
                'key' => self::UNSUPPORTED_MEDIA_TYPE,
                'value'   => 'UNSUPPORTED MEDIA TYPE',
            ],
            [
                'key' => self::RANGE_NOT_SATISFIABLE,
                'value'   => 'RANGE NOT SATISFIABLE',
            ],
            [
                'key' => self::EXPECTATION_FAILED,
                'value'   => 'EXPECTATION FAILED',
            ],
            [
                'key' => self::IM_A_TEAPOT,
                'value'   => 'IM A TEAPOT',
            ],
            [
                'key' => self::MISDIRECTED_REQUEST,
                'value'   => 'MISDIRECTED REQUEST',
            ],
            [
                'key' => self::UNPROCESSABLE_ENTITY,
                'value'   => 'UNPROCESSABLE ENTITY',
            ],
            [
                'key' => self::LOCKED,
                'value'   => 'LOCKED',
            ],
            [
                'key' => self::FAILED_DEPENDENCY,
                'value'   => 'FAILED DEPENDENCY',
            ],
            [
                'key' => self::UPGRADE_REQUIRED,
                'value'   => 'UPGRADE REQUIRED',
            ],
            [
                'key' => self::PRECONDITION_REQUIRED,
                'value'   => 'PRECONDITION REQUIRED',
            ],
            [
                'key' => self::TOO_MANY_REQUESTS,
                'value'   => 'TOO MANY REQUESTS',
            ],
            [
                'key' => self::REQUEST_HEADER_FIELDS_TOO_LARGE,
                'value'   => 'REQUEST HEADER FIELDS TOO LARGE',
            ],
            [
                'key' => self::UNAVAILABLE_FOR_LEGAL_REASONS,
                'value'   => 'UNAVAILABLE FOR LEGAL REASONS',
            ],
            [
                'key' => self::INTERNAL_SERVER_ERROR,
                'value'   => 'INTERNAL SERVER ERROR',
            ],
            [
                'key' => self::NOT_IMPLEMENTED,
                'value'   => 'NOT IMPLEMENTED',
            ],
            [
                'key' => self::BAD_GATEWAY,
                'value'   => 'BAD GATEWAY',
            ],
            [
                'key' => self::SERVICE_UNAVAILABLE,
                'value'   => 'SERVICE UNAVAILABLE',
            ],
            [
                'key' => self::GATEWAY_TIMEOUT,
                'value'   => 'GATEWAY TIMEOUT',
            ],
            [
                'key' => self::HTTP_VERSION_NOT_SUPPORTED,
                'value'   => 'HTTP VERSION NOT SUPPORTED',
            ],
            [
                'key' => self::VARIANT_ALSO_NEGOTIATES,
                'value'   => 'VARIANT ALSO NEGOTIATES',
            ],
            [
                'key' => self::INSUFFICIENT_STORAGE,
                'value'   => 'INSUFFICIENT STORAGE',
            ],
            [
                'key' => self::LOOP_DETECTED,
                'value'   => 'LOOP DETECTED',
            ],
            [
                'key' => self::NOT_EXTENDED,
                'value'   => 'NOT EXTENDED',
            ],
            [
                'key' => self::NETWORK_AUTHENTICATION_REQUIRED,
                'value'   => 'NETWORK AUTHENTICATION REQUIRED'
            ]
        ]);

        return collect($constants);
    }
}
