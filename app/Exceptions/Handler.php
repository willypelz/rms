<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Foundation\Http\Exceptions\MaintenanceModeException as MaintenanceModeException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    private $sentryID;
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $exception)
    {
        if (!env('APP_DEBUG')) {
            if (app()->bound('sentry') && $this->shouldReport($exception)) {
                app('sentry')->captureException($exception);
            }
        }

        parent::report($exception);
    }


    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        // 
        
         if(!env('APP_DEBUG')){
            if ($exception instanceof MaintenanceModeException) {
                return response()->view('errors.maintainance');
            }
            
            if($exception instanceof NotFoundHttpException)
            {
                return response()->view('errors.404', [], 404);
            }
            
            if ($exception instanceof AuthenticationException) {
                return parent::render($request, $exception);
            }

            if ($exception instanceof \Illuminate\Session\TokenMismatchException) {
                if ($request->ajax()) {
                    return response([
                        'error' => 'expired',
                        'success' => false,
                    ], 302);
                } else {
                    return redirect('/');
                }
            }

            if( isset($exception->status) && $exception->status == 422 )
            {
                return parent::render($request, $exception);
            }
            else
            {


                return response()->view('errors.server', [
                    'sentryID' => $this->sentryID,
                ], 500);
            }
                
            

            
        }
        return parent::render($request, $exception);

    }
}
