<?php

namespace App\Services\PullRequests;

use Carbon\Carbon;
use App\Models\Member;
use App\Utilities\Enums;
use App\Models\WebhookLog;
use App\Models\PullRequest;
use App\Contracts\PRInterface;

/**
 *
 * Class PRCreation
 * @package App\Services\PullRequests
 */
class PRCreation implements PRInterface
{
    /**
     * @param WebhookLog $webhookLog
     */
    public function process(WebhookLog $webhookLog): void
    {
        $payload = $webhookLog->data;
        $action = $payload['action'];
        $prState = $payload['pull_request']['state'];
        $draftState = $payload['pull_request']['draft'];
        $condition = ($action === Enums::OPENED || $action === Enums::CLOSED || $action === Enums::REOPENED) &&
            !$draftState && ($prState === Enums::OPEN || $prState === Enums::CLOSED);
        if (!$condition) {
            return;
        }


        if ($action === Enums::OPENED) {
            PullRequest::query()->create([
                'git_id' => $payload['pull_request']['id'],
                'sender_id' => $this->getSenderId($payload['sender']),
                'repository_name' => $payload['repository']['name'],
                'requested_at' => Carbon::parse($payload['pull_request']['created_at']),
                'status' => Enums::OPENED
            ]);
        } else {
            PullRequest::query()->whereGitId($payload['pull_request']['id'])->update(['status' => $action]);
        }

        if ($payload['pull_request']['merged']) {
            PullRequest::query()->whereGitId($payload['pull_request']['id'])->update(['status' => Enums::MERGED]);
        }

        $webhookLog->update(['status' => Enums::SUCCESS]);
    }

    private function getSenderId(array $sender)
    {
        return Member::query()->whereGitId($sender['id'])->value('id');
    }
}
