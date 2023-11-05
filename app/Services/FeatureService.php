<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Traits\ModelHelper;
use App\Models\Feature;

class FeatureService
{
    use ModelHelper;
    public function __construct(private Feature $feature)
    {
    }
    public function getAll()
    {
        return $this->feature->all();
    }

    public function find($featureId)
    {
        return $this->findByIdOrFail(Feature::class,'feature', $featureId);
    }

    public function create($validatedData)
    {
        DB::beginTransaction();

        $feature = $this->feature->create($validatedData);

        DB::commit();

        return $feature;
    }
    public function createMany($product , $validatedData)
    {
        DB::beginTransaction();

        $featuresData = $validatedData['features'];
        $product->features()->delete();
        $featuresToCreate = collect($featuresData)->map(function ($featureData) use ($product) {
            return [
                'title' => $featureData['title'],
                'content' => $featureData['content'],
                'product_id' => $product->id,
            ];
        });
        $product->features()->createMany($featuresToCreate->toArray());

        DB::commit();

        return true;
    }

    public function update($validatedData, $featureId)
    {
        $feature = $this->find($featureId);

        DB::beginTransaction();

        $feature->update($validatedData);

        DB::commit();

        return true;
    }

    public function delete($featureId)
    {
        $feature = $this->find($featureId);

        DB::beginTransaction();

        $feature->delete();

        DB::commit();

        return true;
    }
}
