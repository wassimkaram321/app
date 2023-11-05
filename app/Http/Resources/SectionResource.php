<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
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
            'name'               => $this->name,
            'space'              => $this->space,
            'position'           => $this->position,
            'space_id'           => $this->space_id,
            'vendor_category_id' => $this->vendor_category_id,
            'is_active'          => $this->is_active,
            'created_at'         => $this->created_at
          ];
    }

    public function defaultResource()
    {
        return [
            'id'                 => $this->id,
            'name'               => $this->name,
            'space'              => $this->space,
            'position'           => $this->position,
            'space_id'           => $this->space_id,
            'vendor_category_id' => $this->vendor_category_id,
            'is_active'          => $this->is_active,
            'created_at'         => $this->created_at
          ];
    }
}
