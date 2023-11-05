<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Traits\ModelHelper;
use App\Models\Attribute;

class AttributeService
{
    public function __construct(private Attribute $attribute)
    {
    }
    use ModelHelper;

    public function getAll()
    {
        if(request()->has('page'))
            return $this->attribute->paginate(request()->items_per_page);
        return $this->attribute->all();
    }

    public function find($attributeId)
    {
        return $this->findByIdOrFail(Attribute::class,'attribute', $attributeId);
    }

    public function create($validatedData)
    {
        DB::beginTransaction();

        $attribute = $this->attribute->create($validatedData);

        $attribute->values()->createMany(
            array_map(function ($value) {
                return ['value' => $value];
            }, $validatedData['values'])
        );

        DB::commit();

        return $attribute;
    }

    public function update($validatedData, $attributeId)
    {
        $attribute = $this->find($attributeId);

        DB::beginTransaction();

        $attribute->update($validatedData);
        $attribute->values()->delete();
        $attribute->values()->createMany(
            array_map(function ($value) {
                return ['value' => $value];
            }, $validatedData['values'])
        );

        DB::commit();

        return true;
    }

    public function delete($attributeId)
    {
        $attribute = $this->find($attributeId);

        DB::beginTransaction();

        $attribute->delete();

        DB::commit();

        return true;
    }
}
