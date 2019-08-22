<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Request;
use PDF;
use Mail;

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
        $error_detail = [
            'error_message' => $exception->getMessage(),
            'error_url' => Request::fullUrl(),
            'error_stack_trace' => $exception->getTraceAsString(),
        ];   
        $email_to_list = config('constant.pms_team_emails');
        if(!empty($exception->getMessage()) && $exception->getMessage()!="Unauthenticated.")
        {
        $pdf = PDF::loadView('emails.error_handler', $error_detail);
        $pdf->setPaper('A4', 'portrait');
        foreach($email_to_list as $email)
        {
             // Mail::send('emails.pms_error', $error_detail, function($message) use($error_detail,$email,$pdf)
             //         {
             //             $message->from(config('constant.tridhya_mail'), 'System');
             //             $message->to($email)->subject('Error Occured at Tridhya PMS'); 
             //             $message->attachData($pdf->output(), "pms_error.pdf");
             //         });
        }
        }
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
            return parent::render($request, $exception);    
        if($exception->getMessage()!="Unauthenticated.")
        {
            return redirect('pms/dashboard')->with('error', config('constant.pms_crash_message'));
        }
        else
        {
        }
    }
}
