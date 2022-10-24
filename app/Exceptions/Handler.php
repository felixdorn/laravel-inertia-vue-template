<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Psr\Log\LogLevel;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<Throwable>, LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /** @var array<int, class-string<Throwable>> */
    protected $dontReport = [
        //
    ];

    /** @var array<int, string> */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /** Register the exception handling callbacks for the application. */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
