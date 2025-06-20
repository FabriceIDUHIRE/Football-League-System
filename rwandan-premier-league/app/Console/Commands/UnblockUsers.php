<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Carbon;

class UnblockUsers extends Command
{
    protected $signature = 'users:unblock';
    protected $description = 'Automatically unblock users after 24 hours';

    public function handle()
    {
        $users = User::where('status', 'blocked')
            ->where('blocked_at', '<=', Carbon::now()->subHours(24))
            ->update([
                'status' => 'active',
                'blocked_at' => null
            ]);

        $this->info($users . ' users unblocked successfully.');
    }
}
