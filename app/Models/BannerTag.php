<?php

namespace App\Models;

use Database\Factories\BannerTagFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 
 *
 * @property int $banner_id
 * @property int $tag_id
 * @method static BannerTagFactory factory($count = null, $state = [])
 * @method static Builder|BannerTag newModelQuery()
 * @method static Builder|BannerTag newQuery()
 * @method static Builder|BannerTag query()
 * @method static Builder|BannerTag whereBannerId($value)
 * @method static Builder|BannerTag whereTagId($value)
 * @mixin Eloquent
 */
class BannerTag extends Model
{
    use HasFactory;

    public function banners(): HasMany
    {
        return $this->hasMany(Banner::class, 'id', 'banner_id');
    }

    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class, 'id', 'tag_id');
    }
}
