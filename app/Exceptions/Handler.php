<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            $msg = $exception->getMessage() ?: "Resource not found.";
            return response()->json(["errors" => ["resource_not_found" => [$msg]]], 404);
        } elseif ($exception instanceof \Illuminate\Auth\Access\AuthorizationException) {
            $msg = $exception->getMessage() ?: "Forbidden.";
            return response()->json(["errors" => ["forbidden" => [$msg]]], 403);
        } elseif ($exception instanceof \Illuminate\Auth\AuthenticationException) {
            $msg = $exception->getMessage() ?: "Unauthenticated.";
            return response()->json(["errors" => ["unauthenticated" => [$msg]]], 403);
        } elseif ($exception instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException) {
            return response()->json(["errors" => ["method_not_allowed" => ["Method not allowed."]]], 405);
        } elseif ($exception instanceof \Symfony\Component\HttpKernel\Exception\HttpException) {
            if ($exception->getStatusCode() == 403) {
                $msg = $exception->getMessage() ?: "Forbidden.";
                return response()->json(["errors" => ["forbidden" => [$msg]]], 403);
            }
            if ($exception->getStatusCode() == 401) {
                $msg = $exception->getMessage() ?: "Unauthorized.";
                return response()->json(["errors" => ["unauthorized" => [$msg]]], 403);
            }
        }
        return parent::render($request, $exception);
    }
}
