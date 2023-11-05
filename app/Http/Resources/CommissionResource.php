<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommissionResource extends JsonResource
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
            'created_at' => $this->created_at
          ];
    }

    public function defaultResource()
    {
          return [
            'id'         => $this->id,
            'name'       => $this->name,
            'created_at' => $this->created_at
          ];
    }
    public function getAllWithPagination()
    {

        $commissions = [];
        foreach($this->items() as $commission){
            $commissions [] =  [
                'id'            => $commission->id,
                'name'          => $commission->name,
                'created_at'    => $commission->created_at
            ];
        }
        return [
            'data' => $commissions,
            'pagination' => [
                'total'        => $this->count(),
                'per_page'     => $this->perPage(),
                'current_page' => $this->currentPage(),
                'last_page'    => $this->lastPage(),
            ],
        ];

    }
}
