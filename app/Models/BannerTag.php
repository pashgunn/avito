<?php

namespace App\Models;

use Database\Factories\BannerTagFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 
 *
 * @property int $id
 * @property int $banner_id
 * @property int $tag_id
 * @property-read Collection<int, Banner> $banners
 * @property-read int|null $banners_count
 * @property-read Collection<int, Tag> $tags
 * @property-read int|null $tags_count
 * @method static BannerTagFactory factory($count = null, $state = [])
 * @method static Builder|BannerTag newModelQuery()
 * @method static Builder|BannerTag newQuery()
 * @method static Builder|BannerTag query()
 * @method static Builder|BannerTag whereBannerId($value)
 * @method static Builder|BannerTag whereTagId($value)
 * @method static Builder|BannerTag whereId($value)
 * @mixin Eloquent
 */
class BannerTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'banner_id',
        'tag_id',
    ];

    public $timestamps = false;

    public function banners(): HasMany
    {
        return $this->hasMany(Banner::class, 'id', 'banner_id');
    }

    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class, 'id', 'tag_id');
    }
}
