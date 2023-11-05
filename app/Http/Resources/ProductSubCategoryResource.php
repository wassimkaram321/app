<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductSubCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if(request()->has('page')){
            return $this->getAllWithPagination();
        }
        $actionMethod = $request->route()->getActionMethod();
        return match ($actionMethod) {
            'getAll' => $this->getAllResource(),
             default => $this->defaultResource(),
        };
    }

    public function getAllResource()
    {
          return [
            'id'                  => $this->id,
            'name'                => $this->name,
            'is_active'           => $this->is_active,
            'product_category_id' => $this->product_category_id,
            'created_at'          => $this->created_at
          ];
    }

    public function defaultResource()
    {
        return [
            'id'                  => $this->id,
            'name'                => $this->name,
            'is_active'           => $this->is_active,
            'product_category'    => $this->category,
            'products'            => $this->products,
            'created_at'          => $this->created_at
          ];
    }
    public function getAllWithPagination()
    {

        $subCategories = [];
        foreach($this->items() as $subCategory){
            $subCategories [] =  [
                'id'                  => $subCategory->id,
                'name'                => $subCategory->name,
                'is_active'           => $subCategory->is_active,
                'product_category_id' => $subCategory->product_category_id,
                'products'            => $subCategory->products,
                'created_at'          => $subCategory->created_at
            ];
        }
        return [
            'data' => $subCategories,
            'pagination' => [
                'total'        => $this->count(),
                'per_page'     => $this->perPage(),
                'current_page' => $this->currentPage(),
                'last_page'    => $this->lastPage(),
            ],
        ];

    }
}
