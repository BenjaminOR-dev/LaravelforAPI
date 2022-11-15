<?php

namespace App\Exceptions;

use Throwable;
use App\Enums\HttpStatusEnum;
use App\Helpers\ResponseHelper;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        $status    = $this->isHttpException($th) ? $th->getStatusCode() : 500;
        $message   = $th->getMessage();
        $data      = [];

        if (config('app.debug')) {
            $dataDev = [
                'file'  => $th->getFile(),
                'line'  => $th->getLine(),
                'trace' => $th->getTrace(),
            ];
        }

        if ($th instanceof ValidationException) {
            $status  = HttpStatusEnum::UNPROCESSABLE_ENTITY;
            $message = 'Los datos recibidos son incorrectos';
            $data    = $th->validator->errors()->getMessages();
        }

        if ($th->getPrevious() instanceof ModelNotFoundException) {
            $status  = HttpStatusEnum::NOT_FOUND;
            $th      = $th->getPrevious();

            if (trim($message) === '') {
                $model = class_basename($th->getModel());
                $id    = $th->getIds()[0];
                $message = "No hay resultados para el modelo $model $id";
            }
        }

        if ($th instanceof AuthenticationException) {
            $status  = HttpStatusEnum::UNAUTHORIZED;
            if (trim($message) === '') {
                $message = 'No autorizado';
            }

        }

        if ($th instanceof AuthorizationException) {
            $status  = HttpStatusEnum::FORBIDDEN;
            if (trim($message) === '') {
                $message = 'Acción prohibida';
            }
        }

        if ($th instanceof NotFoundHttpException) {
            $status  = HttpStatusEnum::NOT_FOUND;
            if (trim($message) === '') {
                $message = 'No se encontró';
            }
        }

        return ResponseHelper::jsonError($message, $data, $status);
    }
}
