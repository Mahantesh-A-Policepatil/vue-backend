<?php

namespace App\Console\Commands;

use App\Jobs\SeedCrmUsersJob;
use Illuminate\Console\Command;

class QueueSeedCrmUsersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crm-users:seed-batch {count=200 : Number of CRM users to add} {--sync : Run immediately without queue worker}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatch a queue job that calls the seed_crm_users stored procedure.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $count = (int) $this->argument('count');

        if ($count <= 0) {
            $this->error('The count must be greater than zero.');

            return self::INVALID;
        }

        if ($this->option('sync')) {
            SeedCrmUsersJob::dispatchSync($count);
            $this->info("Added {$count} CRM users synchronously through the stored procedure.");

            return self::SUCCESS;
        }

        SeedCrmUsersJob::dispatch($count);
        $this->info("Queued job to add {$count} CRM users through the stored procedure.");

        return self::SUCCESS;
    }
}
