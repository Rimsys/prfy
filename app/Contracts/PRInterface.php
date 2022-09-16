<?php
namespace App\Contracts;

use App\Models\WebhookLog;
use Illuminate\Support\Collection;

/**
 * Interface PRInterface
 * @package App\Contracts
 */
interface PRInterface
{
    /**
     * @param WebhookLog $webhookLog
     */
    public function process(WebhookLog $webhookLog): void;
}
