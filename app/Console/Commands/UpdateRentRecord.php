<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Console\Command;

class UpdateRentRecord extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-rent-record';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();

        Transaction::where('started_time', '<=', $now)
            ->where('end_time', '>=', $now)
            ->where('status', 'pending')
            ->update(['status' => 'ongoing']);

        Transaction::where('end_time', '<', $now)
            ->where('status', 'ongoing')
            ->update(['status' => 'expired']);

        $this->info('Rent statuses updated successfully.');
    }
}
