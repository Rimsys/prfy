<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\PullRequestComment
 *
 * @property int $id
 * @property int $pull_request_id
 * @property int $requested_reviewer_id
 * @property string $comments
 * @property string $status
 * @property string $submitted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|PullRequestComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PullRequestComment newQuery()
 * @method static \Illuminate\Database\Query\Builder|PullRequestComment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PullRequestComment query()
 * @method static \Illuminate\Database\Eloquent\Builder|PullRequestComment whereComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PullRequestComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PullRequestComment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PullRequestComment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PullRequestComment wherePullRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PullRequestComment whereRequestedReviewerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PullRequestComment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PullRequestComment whereSubmittedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PullRequestComment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|PullRequestComment withTrashed()
 * @method static \Illuminate\Database\Query\Builder|PullRequestComment withoutTrashed()
 * @mixin \Eloquent
 * @property int $reviewer_id
 * @property string|null $edited_at
 * @method static \Illuminate\Database\Eloquent\Builder|PullRequestComment whereEditedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PullRequestComment whereReviewerId($value)
 */
class PullRequestComment extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
}
