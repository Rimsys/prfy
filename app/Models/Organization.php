<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Organization
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Organization query()
 * @method static \Illuminate\Database\Query\Builder|Organization withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Organization newQuery()
 * @method static \Illuminate\Database\Query\Builder|Organization onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Organization withoutTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Organization whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organization newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Organization whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organization whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organization whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organization whereDeletedAt($value)
 * @property int $service_id
 * @property string|null $access_token
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Member[] $member
 * @property-read int|null $member_count
 * @method static \Illuminate\Database\Eloquent\Builder|Organization whereAccessToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organization whereServiceId($value)
 */
class Organization extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function member()
    {
        return $this->hasMany(Member::class);
    }
}
