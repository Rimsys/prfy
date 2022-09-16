<?php

namespace App\Jobs;

use App\Models\WebhookLog;
use App\Services\PullRequests\PRComment;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\PullRequests\PRCreation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ProcessWebhook implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $webhookLog;

    /**
     * Create a new job instance.
     *
     * @param WebhookLog $webhookLog
     */
    public function __construct(WebhookLog $webhookLog)
    {
        $this->webhookLog = $webhookLog;
    }

    /**
     * Execute the job.
     *
     * @param PRCreation $PRCreation
     * @param PRComment $PRComment
     * @return void
     */
    public function handle(PRCreation $PRCreation, PRComment $PRComment)
    {
        $PRCreation->process($this->webhookLog);
        $PRComment->process($this->webhookLog);
    }
}
