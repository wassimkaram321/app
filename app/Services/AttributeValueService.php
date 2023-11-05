<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Traits\ModelHelper;
use App\Models\AttributeValues;

class AttributeValueService
{
    use ModelHelper;
    public function __construct(private AttributeValues $attributeValues)
    {
    }
    public function getAll()
    {
        return  $this->attributeValues::all();
    }

    public function find($attribute_valueId)
    {
        return $this->findByIdOrFail(AttributeValues::class,'attribute_value', $attribute_valueId);
    }

    public function create($validatedData)
    {
        DB::beginTransaction();

        $attribute_value = $this->attributeValues->create($validatedData);

        DB::commit();

        return $attribute_value;
    }

    public function update($validatedData, $attribute_valueId)
    {
        $attribute_value = $this->find($attribute_valueId);

        DB::beginTransaction();

        $attribute_value->update($validatedData);

        DB::commit();

        return true;
    }

    public function delete($attribute_valueId)
    {
        $attribute_value = $this->find($attribute_valueId);

        DB::beginTransaction();

        $attribute_value->delete();

        DB::commit();

        return true;
    }
}
