<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BannerCategoryResource extends JsonResource
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
            'type'       => $this->type,
            'is_active'  => $this->is_active,
            'created_at' => $this->created_at,
            'banners'    => $this->banners,
          ];
    }

    public function defaultResource()
    {
          return [
            'id'         => $this->id,
            'type'       => $this->type,
            'is_active'  => $this->is_active,
            'created_at' => $this->created_at,
            'banners'    => $this->banners
          ];
    }
    public function getAllWithPagination()
    {

        $bannersCategories = [];
        foreach($this->items() as $bannerCategory){
            $bannersCategories [] =  [
                'id'             => $bannerCategory->id,
                'type'           => $bannerCategory->type,
                'is_active'      => $bannerCategory->is_active,
                'created_at'     => $bannerCategory->created_at,
                'banners'        => $bannerCategory->banners,
            ];
        }
        return [
            'data' => $bannersCategories,
            'pagination' => [
                'total'        => $this->count(),
                'per_page'     => $this->perPage(),
                'current_page' => $this->currentPage(),
                'last_page'    => $this->lastPage(),
            ],
        ];

    }
}
