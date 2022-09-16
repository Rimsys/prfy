<?php


namespace App\Services\PullRequests;


use App\Contracts\PRInterface;
use App\Models\Member;
use App\Models\PullRequest;
use App\Models\PullRequestReview;
use App\Models\WebhookLog;
use App\Utilities\Enums;

class PRReviewRequest implements PRInterface
{
    public function process(WebhookLog $webhookLog): void
    {
        $payload = $webhookLog->data->toArray();
        $action = $payload['action'];

        if($action !== Enums::REVIEW_REQUESTED) {
            return;
        }

        PullRequestReview::query()->create([
            'pull_request_id' => $this->getPRId($payload['pull_request']),
            'reviewer_id' => $this->getReviewerId($payload['requested_reviewer']),
            'requested_at' => now()
        ]);

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
