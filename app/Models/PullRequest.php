<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\PullRequest
 *
 * @property int $id
 * @property string $git_id
 * @property int $sender_id
 * @property string $repository_name
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|PullRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PullRequest newQuery()
 * @method static \Illuminate\Database\Query\Builder|PullRequest onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PullRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder|PullRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PullRequest whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PullRequest whereGitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PullRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PullRequest whereRepositoryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PullRequest whereSenderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PullRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PullRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|PullRequest withTrashed()
 * @method static \Illuminate\Database\Query\Builder|PullRequest withoutTrashed()
 * @mixin \Eloquent
 * @property string $requested_at
 * @method static \Illuminate\Database\Eloquent\Builder|PullRequest whereRequestedAt($value)
 */
class PullRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
}
