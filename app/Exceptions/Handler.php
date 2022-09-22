<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as StatusCodes;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if (!$request->is('api/*')) {
            return parent::render($request, $e);
        }

        if ($e instanceof RouteNotFoundException) {
            return response()->json(['message' => $e->getMessage()], StatusCodes::HTTP_NOT_FOUND);
        }

        if ($e instanceof MethodNotAllowedHttpException) {
            return response()->json(['message' => $e->getMessage()], StatusCodes::HTTP_METHOD_NOT_ALLOWED);
        }

        if ($e instanceof NotFoundHttpException) {
            return response()->json(['message' => 'route ' . request()->path() . ' not found'], StatusCodes::HTTP_NOT_FOUND);
        }

        if ($e instanceof ModelNotFoundException) {
            $model = str_replace('App\\Models\\', '', (string)$e->getModel());
            $ids = $e->getIds()[0];
            return response()->json(["message" => "{$model} {$ids} Not found"], StatusCodes::HTTP_NOT_FOUND);
        }

        if ($e instanceof ValidationException) {
            return response()->json([
                'message' => $e->getMessage(),
                'errors' => $e->errors(),
            ], StatusCodes::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($e instanceof AuthenticationException) {
            return response()->json(['message' => $e->getMessage()], StatusCodes::HTTP_UNAUTHORIZED);
        }

        if ($e instanceof AuthenticationException) {
            return response()->json(['message' => $e->getMessage()], StatusCodes::HTTP_UNAUTHORIZED);
        }

        if ($e instanceof Exception) { // QueryExceptions etc
            return response()->json(['message' => $e->getMessage()], StatusCodes::HTTP_BAD_REQUEST);
        }

        parent::prepareJsonResponse($request, $e);
    }
}
