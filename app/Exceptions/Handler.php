<?php

namespace App\Exceptions;

use Throwable;
use App\Enums\HttpStatusEnum;
use App\Helpers\ResponseHelper;
use Illuminate\Database\QueryException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class Handler extends ExceptionHandler
{
    /**
     * Global error message
     *
     * @var string
     */
    private const GLOBAL_ERROR_MESSAGE = 'Internal Server Error. Try later';

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (Throwable $th) {
            return $this->handleException($th);
        });
    }

    /**
     * Handle an exception.
     *
     * @param \Throwable $e
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleException(Throwable $th)
    {
        $message   = $th->getMessage();
        $data      = [];

        if (config('app.debug')) {
            $dataDev = [
                'file'  => $th->getFile(),
                'line'  => $th->getLine(),
                'trace' => $th->getTrace(),
            ];
        }

        /*
         * ****************************************
         *   Most common errors handling
         * ****************************************
         */

        if ($th instanceof ValidationException) {
            $status  = HttpStatusEnum::UNPROCESSABLE_ENTITY;
            $message = 'Los datos recibidos son incorrectos';
            $data    = $th->validator->errors()->getMessages();

            return ResponseHelper::jsonError($message, $data, $status);
        }

        if ($th->getPrevious() instanceof ModelNotFoundException) {
            $status  = HttpStatusEnum::NOT_FOUND;
            $th      = $th->getPrevious();

            if (trim($message) === '') {
                $model = class_basename($th->getModel());
                $id    = $th->getIds()[0];
                $message = "No hay resultados para el modelo {$model} {$id}";
            }

            return ResponseHelper::jsonError($message, $data, $status);
        }

        if ($th instanceof AuthenticationException) {
            $status  = HttpStatusEnum::UNAUTHORIZED;
            if (trim($message) === '') {
                $message = 'No autorizado';
            }

            return ResponseHelper::jsonError($message, $data, $status);
        }

        if ($th instanceof AuthorizationException) {
            $status  = HttpStatusEnum::FORBIDDEN;
            if (trim($message) === '') {
                $message = 'Acción prohibida';
            }

            return ResponseHelper::jsonError($message, $data, $status);
        }

        if ($th instanceof NotFoundHttpException) {
            $status  = HttpStatusEnum::NOT_FOUND;
            if (trim($message) === '') {
                $message = 'No se encontró';
            }

            return ResponseHelper::jsonError($message, $data, $status);
        }

        if ($th instanceof MethodNotAllowedHttpException) {
            $status  = HttpStatusEnum::METHOD_NOT_ALLOWED;
            if (trim($message) === '') {
                $message = 'Método no permitido';
            }

            return ResponseHelper::jsonError($message, $data, $status);
        }

        if ($th instanceof UnprocessableEntityHttpException) {
            $status  = HttpStatusEnum::UNPROCESSABLE_ENTITY;
            $data = json_decode($th->getMessage(), true) ?? $th->getMessage();
            $message = $data['in'][0] ?? 'Los datos recibidos son incorrectos.';

            return ResponseHelper::jsonError($message, $data, $status);
        }

        if ($th instanceof HttpException) {
            $status  = $th->getStatusCode();
            if (trim($message) === '') {
                $message = 'Error';
            }

            return ResponseHelper::jsonError($message, $data, $status);
        }

        if ($th instanceof ThrottleRequestsException) {
            $status  = HttpStatusEnum::TOO_MANY_REQUESTS;
            $message = 'Demasiadas solicitudes';

            return ResponseHelper::jsonError($message, $data, $status);
        }

        if ($th instanceof QueryException) {
            $message = $th->getMessage();
            $code    = $th->errorInfo[1] == 2002 ? 500 : 409;

            return ResponseHelper::jsonError($message, $data, $code);
        }

        /*
         * ****************************************
         *  End Most common errors handling
         * ****************************************
         */

        $status = $this->isHttpException($th) ? $th->getStatusCode() : HttpStatusEnum::INTERNAL_SERVER_ERROR;
        $message = self::GLOBAL_ERROR_MESSAGE;

        if (!config('app.debug')) {
            $message = trim($th->getMessage()) === '' ? $message : $th->getMessage();
            $data    = $dataDev;
        }

        return ResponseHelper::jsonError($message, $data, $status);
    }
}
