<?php
namespace App\Services\PullRequests;


use Carbon\Carbon;
use App\Models\Member;
use App\Utilities\Enums;
use App\Models\PullRequest;
use App\Models\WebhookLog;
use App\Contracts\PRInterface;
use App\Models\PullRequestComment;

/**
 * Class PRComment
 * @package App\Services\PullRequests
 */
class PRComment implements PRInterface
{
    /**
     * @param WebhookLog $webhookLog
     */
    public function process(WebhookLog $webhookLog): void
    {
        $payload = $webhookLog->data->toArray();
//        logger($payload);
        $action = $payload['action'];
        $submitted = $action === Enums::SUBMITTED && array_key_exists('review', $payload);
        $edited = $action === Enums::EDITED && !array_key_exists('review', $payload);

        if (!$submitted &&!$edited) {
            return;
        }

//        logger($action);
        PullRequestComment::query()->create([
            'pull_request_id' => $this->getPRId($payload['pull_request']),
            'reviewer_id' => $this->getReviewerId($payload['sender']),
            'status' => $action,
            'submitted_at' => Carbon::parse($payload['review']['submitted_at']),
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
     * @param array $sender
     * @return mixed
     */
    private function getReviewerId(Array $sender)
    {
        return Member::query()->whereGitId($sender['id'])->value('id');
    }

}
