<?php

namespace App\Jobs;

use App\Models\Banner;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteBanner implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public ?int $tagId = null, public ?int $featureId = null)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->tagId) {
            Banner::query()->whereHas('tags', fn ($query) => $query->where('tag_id', $this->tagId))->delete();
        } elseif ($this->featureId) {
            Banner::query()->where('feature_id', $this->featureId)->delete();
        }
    }
}
