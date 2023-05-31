<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
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


    public function render($request,\Throwable $exception)
    {
        if($request->wantsJson()){

            $exception=$this->prepareException($exception);
//            for validation errors
            if ($exception instanceof ValidationException) {
                $this->renderValidationErrors($request, $exception);
            }

            if ($exception instanceof AuthenticationException){
                $this->renderAuthenticateException();
            }
            return $this->otherExceptions($request,$exception);
        }

        return parent::render($request,$exception);

    }
//validation
    private function renderValidationErrors($request,$exception)
    {
            return response([
                'errors'=>$exception->errors()
            ],422);
     }

     // json for other exception
    private function otherExceptions($request, $exception)
    {
        $code=method_exists($exception,'getStatusCode') ? $exception->getStatusCode(): 500;
        $message= 'خطایی در سمت سرور رخ داده است';
        if (!($code ==500 || empty($exception->getMessage()))){

            $message=$exception->getMessage();
        }
        return response([
            'message'=>$code==500 ?'خطایی در سمت سرور رخ داده است' : $message
        ],$code);
    }

    private function renderAuthenticateException()
    {

        return response([
            'errors'=>'شما به این صفحه دسترسی ندارید'
        ], 401);
    }
}
