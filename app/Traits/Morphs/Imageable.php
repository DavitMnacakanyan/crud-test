<?php

namespace App\Traits\Morphs;

use App\Models\Image;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Imageable
{
    /**
     * @return MorphMany
     */
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
