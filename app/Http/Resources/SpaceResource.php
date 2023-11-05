<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SpaceResource extends JsonResource
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
            'id'         => $this->id,
            'name'       => $this->name,
            'space'      => $this->space,
            'is_active'  => $this->is_active,
            'floor_id'   => $this->floor_id,
            'created_at' => $this->created_at
          ];
    }

    public function defaultResource()
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'space'      => $this->space,
            'is_active'  => $this->is_active,
            'floor_id'   => $this->floor_id,
            'created_at' => $this->created_at
          ];
    }
}
