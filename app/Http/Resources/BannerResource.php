<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
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
            'id'                 => $this->id,
            'start_date'         => $this->start_date,
            'end_date'           => $this->end_date,
            'is_active'          => $this->is_active,
            'banner_category'    => $this->bannerCategory,
            'vendor'             => $this->vendor ?? [],
            'created_at'         => $this->created_at,
            'image'              => $this->getFirstMediaUrl('banners'),
        ];
    }

    public function defaultResource()
    {
        return [
            'id'                 => $this->id,
            'start_date'         => $this->start_date,
            'end_date'           => $this->end_date,
            'is_active'          => $this->is_active,
            'banner_category'    => $this->bannerCategory,
            'vendor'             => $this->vendor ?? [],
            'created_at'         => $this->created_at,
            'image'              => $this->getFirstMediaUrl('banners'),
        ];

    }
    public function getAllWithPagination()
    {

        $banners = [];
        foreach($this->items() as $banner){
            $banners [] =  [
                'id'                 => $banner->id,
                'start_date'         => $banner->start_date,
                'end_date'           => $banner->end_date,
                'is_active'          => $banner->is_active,
                'banner_category'    => $banner->bannerCategory,
                'vendor'             => $banner->vendor ?? [],
                'created_at'         => $banner->created_at,
                'image'              => $banner->getFirstMediaUrl('banners'),

            ];
        }
        return [
            'data' => $banners,
            'pagination' => [
                'total'        => $this->count(),
                'per_page'     => $this->perPage(),
                'current_page' => $this->currentPage(),
                'last_page'    => $this->lastPage(),
            ],
        ];

    }

}
