<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    public function render($request, Exception $exception)
    {
        $flattenedException = FlattenException::create($exception);

        $responseData = [
            'error' => true,
            'message' => $flattenedException->getMessage()
        ];

        if ($_ENV['APP_ENV'] === 'local') {
            $responseData['file'] = $flattenedException->getFile();
            $responseData['line'] = $flattenedException->getLine();
            $responseData['trace'] = $flattenedException->getTrace();
        }

        return new JsonResponse($responseData, $flattenedException->getStatusCode());
    }
}
