<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Team
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property int $company_id
 * @property string $user_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Team query()
 * @method static \Illuminate\Database\Eloquent\Builder|Team newQuery()
 * @method static \Illuminate\Database\Query\Builder|Team withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Team onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Team withoutTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Team newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereUserName($value)
 * @mixin \Eloquent
 * @property int $organization_id
 * @property int $git_id
 * @property string|null $avatar_url
 * @property-read \App\Models\Organization $organization
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereAvatarUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereGitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereOrganizationId($value)
 */
class Member extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'members';

    protected $guarded = [];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
