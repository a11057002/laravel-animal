<?php

namespace App\Exceptions;

use App\Traits\ApiResponseTrait;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException as DatabaseQueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;

class Handler extends ExceptionHandler
{
    // use ApiResponseTrait;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    // protected $dontReport = [
    //     //
    // ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    // protected $dontFlash = [
    //     'current_password',
    //     'password',
    //     'password_confirmation',
    // ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    // public function register()
    // {
    //     $this->reportable(function (Throwable $e) {
    //         //
    //     });
    // }
    public function render($req, Throwable $ex)
    {
        // dd($ex);
        
        if ($req->expectsJson()) {
    
               
                if ($ex instanceof ModelNotFoundException) { 
                    return response()->json(['error' => 'Not found'], Response::HTTP_NOT_FOUND);
                    // returnW $this->errResponse('No Resource Found!', Response::HTTP_NOT_FOUND);
                }
                if ($ex instanceof DatabaseQueryException)
                {
                    return response()->json(['error' => 'Duplicate Data',Response::HTTP_BAD_REQUEST]);
                }
                // if ($ex instanceof NotFoundHttpException) {
                //     return $this->errResponse('Website Not Found!', Response::HTTP_NOT_FOUND);
                // }
                // if ($ex instanceof MethodNotAllowedException) {
                //     return $this->errResponse('Method Not Allowed!', Response::HTTP_NOT_FOUND);
                // }
            
        }

        return parent::render($req, $ex);
    }
}
