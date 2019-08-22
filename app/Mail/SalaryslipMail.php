<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SalaryslipMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $pdf;
    public $employee;
    public $personal_email;
    public $emp_name;
    public $month_year;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pdf,$employee)
    {
        $this->pdf = base64_encode($pdf->output());
        $this->employee = $employee;
        $this->personal_email = $employee['personal_email'];
        $this->emp_name = $employee['emp_name'];
        $this->month_year = $employee['month_year'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.salary_slip')
                    ->from(config('constant.tridhya_mail'),'Tridhya HR')
                    ->to($this->personal_email, $this->emp_name)
                    ->subject('Salary Slip for ' . $this->month_year)
                    ->attachData(base64_decode($this->pdf), 'salary_slip.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
