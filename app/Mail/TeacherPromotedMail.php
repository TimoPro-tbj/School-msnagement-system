<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TeacherPromotedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $teacher;
    public $email;
    public $plainPassword;
    public $schoolCode;

    public function __construct($teacher, $email, $plainPassword, $schoolCode)
    {
        $this->teacher = $teacher;
        $this->email = $email;
        $this->plainPassword = $plainPassword;
        $this->schoolCode = $schoolCode;
    }

    public function build()
    {
        return $this->subject('You have been promoted to Admin')
                    ->view('emails.teacher_promoted');
    }
}
