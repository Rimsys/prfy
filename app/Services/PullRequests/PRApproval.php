<?php

namespace App\Services\PullRequests;


use App\Contracts\PRInterface;
use App\Models\Member;
use App\Models\PullRequest;
use App\Models\PullRequestReview;
use App\Models\WebhookLog;
use App\Utilities\Enums;

/**
 * Class PRApproval
 * @package App\Services\PullRequests
 */
class PRApproval implements PRInterface
{
    /**
     * @param WebhookLog $webhookLog
     */
    public function process(WebhookLog $webhookLog): void
    {
        $payload = $webhookLog->data->toArray();
        $action = $payload['action'];
        $reviewState = $payload['review']['state'];
        $prState = $payload['pull_request']['state'];
        $draftState = $payload['pull_request']['draft'];

        $condition = $action === Enums::SUBMITTED && $prState === Enums::OPEN && $reviewState === Enums::APPROVED && !$draftState;
        if (!$condition) {
            return;
        }

        PullRequestReview::query()
            ->wherePullRequestId($this->getPRId($payload['pull_request']))
            ->whereReviewerId($this->getReviewerId($payload['review']['user']))
            ->whereNotNull('approved_at')
            ->update(['approved_at' => now()]);

        $webhookLog->update(['status' => Enums::SUCCESS]);
    }

    /**
     * @param array $pullRequest
     * @return mixed
     */
    private function getPRId(Array $pullRequest)
    {
        return PullRequest::query()->whereGitId($pullRequest['id'])->value('id');
    }

    /**
     * @param array $reviewer
     * @return mixed
     */
    private function getReviewerId(Array $reviewer)
    {
        return Member::query()->whereGitId($reviewer['id'])->value('id');
    }
}
