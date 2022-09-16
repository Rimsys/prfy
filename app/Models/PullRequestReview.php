<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\PullRequestReview
 *
 * @property int $id
 * @property int $pull_request_id
 * @property int $requested_reviewer_id
 * @property string $status
 * @property string $requested_at
 * @property string|null $approved_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|PullRequestReview newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PullRequestReview newQuery()
 * @method static \Illuminate\Database\Query\Builder|PullRequestReview onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PullRequestReview query()
 * @method static \Illuminate\Database\Eloquent\Builder|PullRequestReview whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PullRequestReview whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PullRequestReview whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PullRequestReview whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PullRequestReview wherePullRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PullRequestReview whereRequestedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PullRequestReview whereRequestedReviewerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PullRequestReview whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PullRequestReview whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|PullRequestReview withTrashed()
 * @method static \Illuminate\Database\Query\Builder|PullRequestReview withoutTrashed()
 * @mixin \Eloquent
 * @property int $reviewer_id
 * @method static \Illuminate\Database\Eloquent\Builder|PullRequestReview whereReviewerId($value)
 */
class PullRequestReview extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function pr()
    {
        return $this->belongsTo(PullRequest::class);
    }
}
