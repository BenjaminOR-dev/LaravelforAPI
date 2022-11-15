<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Str;
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
     * Response standard for API
     *
     * @param int $status
     * @param array|object $data
     * @param string|null $message
     * @return \Illuminate\Http\JsonResponse
     */
    private function standard(int $status, $data = [], string $message = null)
    {
        $response = [
            'status'      => $status,
            'request-id'  => self::getRequestId(),
            'server'      => [
                'host'     => request()->getHost(),
                'datetime' => Carbon::now()->toDateTimeString()
            ],
            'message'     => $message,
            'data'        => $data,
        ];

        return response()->json($response, $status);
    }

    /**
     * Response status 404
     *
     * @return void
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public static function send404(): void
    {
        abort(
            HttpStatusEnum::NOT_FOUND,
            'La solicitud se realizó de forma correcta, sin embargo, el servicio no obtuvo información alguna.'
        );
    }

    /**
     * Response json
     *
     * @param array|object $data
     * @param string|null $message
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public static function json($data = [], string $message = null, int $status = HttpStatusEnum::OK)
    {
        return (new Self)->standard(HttpStatusEnum::OK, $data, $message);
    }

    /**
     * Get the request id
     *
     * @return string
     */
    public static function getRequestId(): string
    {
        return request()->header('X-Request-ID') ?? Str::uuid();
    }
}
