<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VendorResource extends JsonResource
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
            'id'                   => $this->id,
            'name'                 => $this->name,
            'description'          => $this->description,
            'slug'                 => $this->slug,
            'latitude'             => $this->latitude,
            'longitude'            => $this->longitude,
            'address'              => $this->address,
            'phone'                => $this->phone,
            'email'                => $this->email,
            'is_active'            => $this->is_active,
            'vendor_category_id'   => $this->vendorCategory->id ?? null,
            'vendor_category_name' => $this->vendorCategory->name ?? null,
            'city_id'              => $this->city_id,
            'created_at'           => $this->created_at,
            'image'                => $this->getFirstMediaUrl('vendors'),
            'images'               => $this->getMedia('vendor-images'),
        ];

    }

    public function defaultResource()
    {
        return [
            'id'                   => $this->id,
            'name'                 => $this->name,
            'description'          => $this->description,
            'slug'                 => $this->slug,
            'latitude'             => $this->latitude,
            'longitude'            => $this->longitude,
            'address'              => $this->address,
            'phone'                => $this->phone,
            'email'                => $this->email,
            'is_active'            => $this->is_active,
            'vendor_category_id'   => $this->vendorCategory->id ?? null,
            'vendor_category_name' => $this->vendorCategory->name ?? null,
            'city_id'              => $this->city_id,
            'created_at'           => $this->created_at,
            'image'                => $this->getFirstMediaUrl('vendors'),
            'images'               => $this->getMedia('vendor-images'),
        ];
    }
    public function getAllWithPagination()
    {

        $vendors = [];
        foreach($this->items() as $vendor){
            $vendors [] =  [
                'id'                   => $vendor->id,
                'name'                 => $vendor->name,
                'description'          => $vendor->description,
                'slug'                 => $vendor->slug,
                'latitude'             => $vendor->latitude,
                'longitude'            => $vendor->longitude,
                'address'              => $vendor->address,
                'phone'                => $vendor->phone,
                'email'                => $vendor->email,
                'is_active'            => $vendor->is_active,
                'vendor_category_id'   => $vendor->vendorCategory->id ?? null,
                'vendor_category_name' => $vendor->vendorCategory->name ?? null,
                'city_id'              => $vendor->city_id,
                'created_at'           => $vendor->created_at,
                'image'                => $vendor->getFirstMediaUrl('vendors'),
                'images'               => $vendor->getMedia('vendor-images'),
        ];
        }
        return [
            'data' => $vendors,
            'pagination' => [
                'total'        => $this->count(),
                'per_page'     => $this->perPage(),
                'current_page' => $this->currentPage(),
                'last_page'    => $this->lastPage(),
            ],
        ];

    }
}
