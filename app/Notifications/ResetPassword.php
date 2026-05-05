<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as BaseResetPassword;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ResetPassword extends BaseResetPassword implements ShouldQueue
{
    use Queueable;

    public $tries = 3;

    public $backoff = 10;
}
