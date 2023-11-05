<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
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
            'id'              => $this->id,
            'model'           => $this->model,
            'collection_name' => $this->collection_name,
            'name'            => $this->name,
            'file_name'       => $this->file_name,
          ];
    }

    public function defaultResource()
    {
        return [
            'id'              => $this->id,
            'model'           => $this->model,
            'collection_name' => $this->collection_name,
            'name'            => $this->name,
            'file_name'       => $this->file_name,
          ];
    }
}
