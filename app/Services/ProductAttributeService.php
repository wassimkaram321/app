<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Traits\ModelHelper;
use App\Models\ProductAttribute;
use App\Models\Attribute;

class ProductAttributeService
{
    use ModelHelper;

    public function __construct
    (
        private AttributeService $attributeService,
        private ProductAttribute $productAttribute
    )
    {
    }
    public function getAll()
    {
        return $this->productAttribute->all();
    }

    public function find($product_attributeId)
    {
        return $this->findByIdOrFail(ProductAttribute::class,'product_attribute', $product_attributeId);
    }

    public function create($validatedData)
    {
        DB::beginTransaction();

        $product_attribute = $this->productAttribute->create($validatedData);

        DB::commit();

        return $product_attribute;
    }
    public function createMany($prodcut,$validatedData)
    {
        DB::beginTransaction();

        $attributesData = $validatedData['attributes'];
        $attributesToSync = collect($attributesData)->mapWithKeys(function ($attributeData) {
            $attribute = $this->attributeService->find($attributeData['attribute_id']);

            if ($attribute) {
                return [
                    $attribute->id => [
                        'selected_value' => $attributeData['selected_value'],
                        'quantity' => $attributeData['quantity'],
                    ],
                ];
            }

            return [];
        })->toArray();

        $prodcut->attributes()->sync($attributesToSync);

        DB::commit();

        return true;
    }

    public function update($validatedData, $product_attributeId)
    {
        $product_attribute = $this->find($product_attributeId);

        DB::beginTransaction();

        $product_attribute->update($validatedData);

        DB::commit();

        return true;
    }

    public function delete($product_attributeId)
    {
        $product_attribute = $this->find($product_attributeId);

        DB::beginTransaction();

        $product_attribute->delete();

        DB::commit();

        return true;
    }
}
