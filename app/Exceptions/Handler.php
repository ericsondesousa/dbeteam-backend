<?php

namespace App\Exceptions;

use Throwable;
use ErrorException;
use Illuminate\Http\Response;
use App\Services\ErrorService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render the exception in JSON response.
     */
    public function render($request, Throwable $exception)
    {
        $errorService = new ErrorService();
        $error = $exception->getMessage();
        $status = Response::HTTP_BAD_REQUEST;

        // 404
        if ($exception instanceof ModelNotFoundException) {
            $model = app($exception->getModel());
            $error = method_exists($model, 'notFoundMessage') ?
                $model->notFoundMessage() :
                __('Register not found');
            $status = Response::HTTP_NOT_FOUND;
        }

        // 401
        if ($exception instanceof AuthenticationException) {
            $error = __('Unauthorized');
            $status = Response::HTTP_UNAUTHORIZED;
        }

        // errors
        if ($exception instanceof ErrorException) {
            if ($exception->getCode() > 0) {
                $status =  $exception->getCode();
            }
        }

        return response()->json($errorService->generateError($error), $status);
    }
}
