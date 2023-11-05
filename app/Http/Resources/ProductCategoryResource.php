<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCategoryResource extends JsonResource
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
            'id'               => $this->id,
            'name'             => $this->name,
            'is_active'        => $this->is_active,
            'created_at'       => $this->created_at,
            'products'         => $this->products,
            'sub_categories'   => $this->productSubCategories,
          ];
    }

    public function defaultResource()
    {
        return [
            'id'               => $this->id,
            'name'             => $this->name,
            'is_active'        => $this->is_active,
            'created_at'       => $this->created_at,
            'products'         => $this->products,
            'sub_categories'   => $this->productSubCategories,
          ];
    }
    public function getAllWithPagination()
    {

        $categories = [];
        foreach($this->items() as $category){
            $categories [] =  [
                'id'               => $category->id,
                'name'             => $category->name,
                'is_active'        => $category->is_active,
                'created_at'       => $category->created_at,
                'products'         => $category->products,
                'sub_categories'   => $category->productSubCategories,
            ];
        }
        return [
            'data' => $categories,
            'pagination' => [
                'total'        => $this->count(),
                'per_page'     => $this->perPage(),
                'current_page' => $this->currentPage(),
                'last_page'    => $this->lastPage(),
            ],
        ];

    }
}
