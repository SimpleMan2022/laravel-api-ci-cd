<?php

namespace App\Exceptions;

use App\Helpers\ResponseHelper;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

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

    public function render($request, Throwable $exception)
    {
        // Tangani error validasi secara global
        if ($exception instanceof ValidationException) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation error',
                'errors' => $exception->errors(),
            ], 400);
        }

        // Panggil metode bawaan untuk pengecualian lain
        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        // Cek apakah request berasal dari API atau aplikasi
        if ($request->expectsJson()) {
            return ResponseHelper::respond(401, 'Unauthenticated');
        }
    }
}
