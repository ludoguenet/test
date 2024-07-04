<?php

namespace App\Jobs;

use App\Actions\LongAction;
use App\Mail\WelcomeMail;
use App\Models\User;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use RuntimeException;
use Throwable;

class LongActionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 4;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
    try {
        (new LongAction)->handle();
    } catch (Exception $exception) {
        report($exception);
    }
    }

    public function failed(?Throwable $exception): void
    {
        Mail::to(User::first())->send(new WelcomeMail);
    }
}
