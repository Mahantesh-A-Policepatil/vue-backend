<?php

namespace App\Jobs;

use App\Repositories\Contracts\CrmUserRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SeedCrmUsersJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public int $count = 200)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(CrmUserRepositoryInterface $crmUserRepository): void
    {
        $crmUserRepository->seedUsingProcedure($this->count);
    }
}
