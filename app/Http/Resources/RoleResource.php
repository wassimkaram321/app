<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
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
            'created_at' => $this->created_at,
          ];
    }

    public function defaultResource()
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'created_at' => $this->created_at,
          ];
    }
    public function getAllWithPagination()
    {

        $attributes = [];
        foreach($this->items() as $attribute){
            $attributes [] =  [
                'id'             => $attribute->id,
                'name'           => $attribute->name,
                'is_active'      => $attribute->is_active,
                'created_at'     => $attribute->created_at,
                'values'         => $attribute->values,
            ];
        }
        return [
            'data' => $attributes,
            'pagination' => [
                'total'        => $this->count(),
                'per_page'     => $this->perPage(),
                'current_page' => $this->currentPage(),
                'last_page'    => $this->lastPage(),
            ],
        ];

    }
}
