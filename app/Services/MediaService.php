<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Traits\ModelHelper;
use App\Traits\UploadImageTrait;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
class MediaService
{
    use ModelHelper , UploadImageTrait;
    public function __construct(private Media $media)
    {
    }
    public function getAll()
    {
        return $this->media->all();
    }

    public function find($mediaId)
    {
        return $this->findByIdOrFail(Media::class,'media', $mediaId);
    }

    public function create($validatedData)
    {
        DB::beginTransaction();

        $modelClassName = '\App\Models\\' . $validatedData['model_class'];
        $model = $modelClassName::findOrFail($validatedData['model_id']);
        if (isset($validatedData['image']))
            $this->uploadImage($model,request()->image,$validatedData['collection_name']);


        DB::commit();

        return true;
    }

    public function update($validatedData, $mediaId)
    {
        $media = $this->find($mediaId);

        DB::beginTransaction();

        $media->update($validatedData);

        DB::commit();

        return true;
    }

    public function delete($mediaId)
    {
        $media = $this->find($mediaId);

        DB::beginTransaction();

        $media->delete();

        DB::commit();

        return true;
    }
}
