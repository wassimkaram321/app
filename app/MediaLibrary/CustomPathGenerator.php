<?php

namespace App\MediaLibrary;

use App\Models\Banner;
use App\Models\Product;
use App\Models\Vendor;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

/**
 * Class CustomPathGenerator
 * @package App\MediaLibrary
 */
class CustomPathGenerator implements PathGenerator
{
    /**
     * @param Media $media
     *
     * @return string
     */
    public function getPath(Media $media): string
    {
        switch ($media->model_type) {
            case Banner::class:
                return Banner::PATH . '/' . $media->id . '/';
                break;
            case Vendor::class:
                return Vendor::PATH . '/' . $media->id . '/';
                break;
            case Product::class:
                return Product::PATH . '/' . $media->id . '/';
                break;
            default:
                return $media->id . DIRECTORY_SEPARATOR;
        }
    }

    /**
     * @param Media $media
     *
     * @return string
     */
    public function getPathForConversions(Media $media): string
    {
        return $this->getPath($media) . 'thumbnails/';
    }

    /**
     * @param Media $media
     *
     * @return string
     */
    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getPath($media) . 'rs-images/';
    }
}
