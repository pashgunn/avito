<?php

namespace App\Models;

use Database\Factories\FeatureFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Banner> $banners
 * @property-read int|null $banners_count
 * @method static FeatureFactory factory($count = null, $state = [])
 * @method static Builder|Feature newModelQuery()
 * @method static Builder|Feature newQuery()
 * @method static Builder|Feature query()
 * @method static Builder|Feature whereCreatedAt($value)
 * @method static Builder|Feature whereId($value)
 * @method static Builder|Feature whereName($value)
 * @method static Builder|Feature whereUpdatedAt($value)
 * @method static Builder|Feature whereFeatureId($value)
 * @mixin Eloquent
 */
class Feature extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function banners(): HasMany
    {
        return $this->hasMany(Banner::class, 'feature_id');
    }
}
