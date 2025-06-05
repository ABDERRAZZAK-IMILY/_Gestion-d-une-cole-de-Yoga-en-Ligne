<?php
namespace App\Mail;

use Illuminate\Mail\Mailable;
use App\Models\Student;

class SubscriptionReminder extends Mailable
{
    public $student;

    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    public function build()
    {
        return $this->subject('Votre abonnement YogaZen expire bientôt !')
                    ->view('emails.subscription_reminder');
    }
}
