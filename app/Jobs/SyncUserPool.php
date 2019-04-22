<?php

namespace App\Jobs;

use App\Models\Pool;
use App\Models\User;
use App\Models\UserPool;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SyncUserPool implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $pool;
    protected $user;

    /**
     * SyncUserPool constructor.
     * @param Pool $pool
     * @param User $user
     * @param bool $type
     */
    public function __construct(Pool $pool,User $user)
    {
        //
        $this->pool = $pool;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $create = [
            'user_id'=>$this->user['id'],
            'pool_id'=>$this->pool['id']
        ];

        UserPool::create($create);

    }
}
