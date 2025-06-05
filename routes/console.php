<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


use App\Jobs\ManageSubscriptionsJob;
use Illuminate\Support\Facades\Schedule;

Schedule::job(new ManageSubscriptionsJob)->cron('0 0 * * *');
