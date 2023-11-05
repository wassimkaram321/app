<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VendorCategoryResource extends JsonResource
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
            'id'         => $this->id,
            'name'       => $this->name,
            'is_active'  => $this->is_active,
            'created_at' => $this->created_at,

          ];
    }

    public function defaultResource()
    {
          return [
            'id'         => $this->id,
            'name'       => $this->name,
            'is_active'  => $this->is_active,
            'created_at' => $this->created_at,
            'vendors'    => $this->vendors,
          ];
    }
    public function getAllWithPagination()
    {

        $vendorCategories = [];
        foreach($this->items() as $vendorCategory){
            $vendorCategories [] =  [
                'id'         => $vendorCategory->id,
                'name'       => $vendorCategory->name,
                'is_active'  => $vendorCategory->is_active,
                'created_at' => $vendorCategory->created_at,
                'vendors'    => $vendorCategory->vendors,
            ];
        }
        return [
            'data' => $vendorCategories,
            'pagination' => [
                'total'        => $this->count(),
                'per_page'     => $this->perPage(),
                'current_page' => $this->currentPage(),
                'last_page'    => $this->lastPage(),
            ],
        ];

    }
}
