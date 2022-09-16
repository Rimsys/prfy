<?php


namespace App\Services\PullRequests;


use App\Contracts\PRInterface;
use App\Models\Member;
use App\Models\PullRequest;
use App\Models\PullRequestReview;
use App\Models\WebhookLog;
use App\Utilities\Enums;

/**
 * Class PRReviewRequest
 * @package App\Services\PullRequests
 */
class PRReviewRequest implements PRInterface
{
    public function process(WebhookLog $webhookLog): void
    {
        $payload = $webhookLog->data->toArray();
        $action = $payload['action'];

        if($action !== Enums::REVIEW_REQUESTED && $action !== Enums::REVIEW_REQUESTED_REMOVED) {
            return;
        }

        $pr = $this->getPR($payload['pull_request']);
        if (!$pr || $pr->status === Enums::CLOSED || $payload['pull_request']['draft'] || $payload['pull_request']['merged']) {
            return;
        }

        $reviewerId = $this->getReviewerId($payload['requested_reviewer']);

        if ($action === Enums::REVIEW_REQUESTED_REMOVED) {
            PullRequestReview::query()->wherePullRequestId($pr->id)->whereReviewerId($reviewerId)->update(['state' => Enums::REVIEW_REQUESTED_REMOVED]);
            return;
        }

        $prRequest = PullRequestReview::query()
            ->wherePullRequestId($pr->id)
            ->whereReviewerId($reviewerId)
            ->whereStatus(Enums::REVIEW_REQUESTED)
            ->whereNull('approved_at')->first();

        if ($prRequest) {
            $prRequest->update(['requested_at' => now()]);
        } else {
            PullRequestReview::query()->create([
                'pull_request_id' => $pr->id,
                'reviewer_id' => $reviewerId,
                'requested_at' => now()
            ]);
        }

        $webhookLog->update(['status' => Enums::SUCCESS]);

    }

    /**
     * @param array $pullRequest
     * @return mixed
     */
    private function getPR(Array $pullRequest): PullRequest
    {
        return PullRequest::query()->whereGitId($pullRequest['id'])->first();
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
