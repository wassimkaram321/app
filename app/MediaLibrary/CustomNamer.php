<?php

namespace App\MediaLibrary;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\DefaultPathGenerator;

class CustomNamer extends DefaultPathGenerator
{
    public function getPath(Media $media): string
    {
        // dd($media->getKey());
        $prefix = config('media-library.prefix', '');

        if ($prefix !== '') {
            return $prefix . '/' . $media->getKey();
        }

        return '';
        // return $this->getBasePath($media);
    }
}
