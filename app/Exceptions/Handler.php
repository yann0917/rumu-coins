<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Throwable;

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
     * @param Throwable $exception
     * @return void
     * @throws Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param Request   $request
     * @param Throwable $exception
     * @return Response
     * @throws Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof \HttpException) {
            return \response()->make('', $exception->getCode());
        }

        if ($exception instanceof UnauthorizedHttpException) {
            $response['code'] = Errors::ERR_INVALID_TOKEN;
        } else {
            $response['code'] = $exception->getCode();
        }
        $response['message'] = $exception->getMessage() ?? $exception->getCode();
        $response['data'] = (object)[];
        return \response()->json($response, 200, [], JSON_UNESCAPED_UNICODE);
        // return parent::render($request, $exception);
    }
}
