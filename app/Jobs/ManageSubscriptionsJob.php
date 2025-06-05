<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Subscription;
use App\Models\Student;
use App\Mail\SubscriptionReminder;
use App\Models\JobLog;
use Illuminate\Support\Facades\Mail;



class ManageSubscriptionsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $expiring = Subscription::whereBetween('expires_at', [now(), now()->addDays(3)])->get();

        foreach ($expiring as $subscription) {
            $student = $subscription->student;
            Mail::to($student->email)->send(new SubscriptionReminder($student));

            JobLog::create([
                'action' => 'reminder_sent',
                'details' => 'Rappel envoyé à ' . $student->email,
            ]);
        }

        $inactive = Student::where('status', 'active')
                           ->where('updated_at', '<', now()->subMonths(12))
                           ->get();

        foreach ($inactive as $student) {
            $student->update(['status' => 'archived']);
            JobLog::create([
                'action' => 'account_archived',
                'details' => 'Compte archivé pour ' . $student->email,
            ]);
        }
    }
}
