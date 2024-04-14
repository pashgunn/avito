<?php

namespace App\Models;

use Database\Factories\BannerFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $feature_id
 * @property string $content
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property bool $is_active
 * @property-read Feature $feature
 * @property-read Collection<int, Tag> $tags
 * @property-read int|null $tags_count
 *
 * @method static BannerFactory factory($count = null, $state = [])
 * @method static Builder|Banner newModelQuery()
 * @method static Builder|Banner newQuery()
 * @method static Builder|Banner query()
 * @method static Builder|Banner whereCreatedAt($value)
 * @method static Builder|Banner whereFeatureId($value)
 * @method static Builder|Banner whereId($value)
 * @method static Builder|Banner whereJsonData($value)
 * @method static Builder|Banner whereUpdatedAt($value)
 * @method static Builder|Banner whereIsEnabled($value)
 * @method static Builder|Banner whereBannerId($value)
 *
 * @property string $json_data
 * @property bool $is_enabled
 *
 * @method static Builder|Banner whereContent($value)
 * @method static Builder|Banner whereIsActive($value)
 *
 * @mixin Eloquent
 */
class Banner extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function feature(): BelongsTo
    {
        return $this->belongsTo(Feature::class, 'feature_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'banner_tags', 'banner_id', 'tag_id');
    }
}
