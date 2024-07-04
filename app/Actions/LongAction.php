<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class LongAction
{

    public function handle(): void
    {
            throw new RuntimeException('Oops');

            sleep(5);
    }
}
