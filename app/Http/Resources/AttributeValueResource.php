<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AttributeValueResource extends JsonResource
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
            'id'           => $this->id,
            'attribute_id' => $this->attribute_id,
            'value'        => $this->value,
            'created_at'   => $this->created_at
          ];
    }

    public function defaultResource()
    {
        return [
            'id'           => $this->id,
            'attribute_id' => $this->attribute_id,
            'value'        => $this->value,
            'created_at'   => $this->created_at
          ];
    }
}
