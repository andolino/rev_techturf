<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $details;
    public function __construct($details){
        //
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        switch ($this->details['dest']) {
            case 'student_booked_lesson':
                return $this->markdown('emails.student_booked_lesson');
                break;
            case 'registration':
                return $this->markdown('emails.student_reg_mail');
                break;
            case 'teacher_cancelled_lesson':
                return $this->markdown('emails.teacher_cancelled_lesson');
                break;
            case 'teacher_confirmed_lesson':
                return $this->markdown('emails.teacher_confirmed_lesson');
                break;
            case 'student_reschedule_booked':
                return $this->markdown('emails.student_reschedule_booked');
                break;
            default:
                break;
        }
    }
}
