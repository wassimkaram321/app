<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id'                => $this->id,
            'first_name'        => $this->first_name,
            'last_name'         => $this->last_name,
            'email'             => $this->email,
            'password'          => $this->password,
            'address'           => $this->address,
            'phone'             => $this->phone,
            'email_verified_at' => $this->email_verified_at,
            'last_login_at'     => $this->last_login_at,
            'gender'            => $this->gender,
            'status'            => $this->status,
            'role_id'           => $this->role_id,
            'created_at'        => $this->created_at,
            'wallet_amount'     => $this->wallet->amount
          ];
    }

    public function defaultResource()
    {
        return [
            'id'                => $this->id,
            'first_name'        => $this->first_name,
            'last_name'         => $this->last_name,
            'email'             => $this->email,
            'password'          => $this->password,
            'address'           => $this->address,
            'phone'             => $this->phone,
            'email_verified_at' => $this->email_verified_at,
            'last_login_at'     => $this->last_login_at,
            'gender'            => $this->gender,
            'status'            => $this->status,
            'role_id'           => $this->role_id,
            'created_at'        => $this->created_at,
            'wallet_amount'     => $this->wallet->amount
          ];
    }
}
