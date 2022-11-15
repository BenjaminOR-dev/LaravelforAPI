<?php

namespace App\Helpers;

use App\Enums\HttpStatusEnum;

/**
 * ResponseHelper
 *
 * @package App\Helpers
 * @author Ing. Benjamin Olvera Rosales
 */
class ResponseHelper
{
    /**
     * Response status 404
     *
     * @return void
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @author Ing. Benjamín Olvera Rosales
     */
    public static function send404() : void
    {
        abort(
            HttpStatusEnum::NOT_FOUND,
            'La solicitud se realizó de forma correcta, sin embargo, el servicio no obtuvo información alguna.'
        );
    }
}
