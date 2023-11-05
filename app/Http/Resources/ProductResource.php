<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'uuid'                => $this->uuid,
            'name'                => $this->name,
            'description'         => $this->description,
            'price'               => $this->price,
            'slug'                => $this->slug,
            'quantity'            => $this->quantity,
            'is_active'           => $this->is_active,
            'is_returnable'       => $this->is_returnable,
            'is_cancelable'       => $this->is_cancelable,
            'is_replaceable'      => $this->is_replaceable,
            'availability'        => $this->availability,
            'vendor_id'           => $this->vendor_id,
            'category'            => [
                                        'id'   => $this->categorizable->id,
                                        'name' => $this->categorizable->name,
                                        'type' => class_basename($this->categorizable_type),
                                     ],
            'commission_id'       => $this->commission_id,
            'commission_value'    => $this->commission_value,
            'created_at'          => $this->created_at,
            'attributes'          => $this->attributes->map(function ($attribute) {
                return [
                                    'id'                => $attribute->id,
                                    'name'              => $attribute->name,
                                    'selected_value'    => $attribute->pivot->selected_value,
                                    'quantity'          => $attribute->pivot->quantity,

                ];
            }),
            'features'            => $this->features->map(function ($feature) {
                return [
                                    'id'                 => $feature->id,
                                    'title'              => $feature->title,
                                    'content'            => $feature->content,

                ];
            }),
            'image'              => $this->getFirstMediaUrl('products'),
            'images'             => $this->getMedia('product-images'),
          ];
    }

    public function defaultResource()
    {
        $this->commission->commission_value = $this->commission_value;
        return [
            'id'                  => $this->id,
            'uuid'                => $this->uuid,
            'name'                => $this->name,
            'description'         => $this->description,
            'price'               => $this->price,
            'slug'                => $this->slug,
            'quantity'            => $this->quantity,
            'is_active'           => $this->is_active,
            'is_returnable'       => $this->is_returnable,
            'is_cancelable'       => $this->is_cancelable,
            'is_replaceable'      => $this->is_replaceable,
            'availability'        => $this->availability,
            'vendor'              => $this->vendor,
            'category'            => [
                                        'id'   => $this->categorizable->id,
                                        'name' => $this->categorizable->name,
                                        'type' => class_basename($this->categorizable_type),
                                     ],
            // 'commission_id'       => $this->commission_id,
            // 'commission_value'    => $this->commission_value,
            'commission'          => $this->commission,
            'created_at'          => $this->created_at,
            'attributes'          => $this->attributes->map(function ($attribute) {
                return [
                                    'id'                => $attribute->id,
                                    'name'              => $attribute->name,
                                    'selected_value'    => $attribute->pivot->selected_value,
                                    'quantity'          => $attribute->pivot->quantity,

                ];
            }),
            'features'            => $this->features->map(function ($feature) {
                return [
                                    'id'                 => $feature->id,
                                    'title'              => $feature->title,
                                    'content'            => $feature->content,

                ];
            }),
            'image'              => $this->getFirstMediaUrl('products'),
            'images'             => $this->getMedia('product-images'),
          ];
    }
    public function getAllWithPagination()
    {

        $products = [];
        foreach($this->items() as $product){
            $products [] =  [
                'id'                  => $product->id,
                'name'                => $product->name,
                'price'               => $product->price,
                'quantity'            => $product->quantity,
                'is_active'           => $product->is_active,
                'created_at'          => $product->created_at,
            ];
        }
        return [
            'data' => $products,
            'pagination' => [
                'total'        => $this->count(),
                'per_page'     => $this->perPage(),
                'current_page' => $this->currentPage(),
                'last_page'    => $this->lastPage(),
            ],
        ];

    }
}
