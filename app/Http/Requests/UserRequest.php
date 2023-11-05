<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

         return match ($this->route()->getActionMethod()) {
            'create'   =>  $this->getCreateRules(),
            'update'   =>  $this->getUpdateRules(),
        };
    }

    public function getCreateRules()
    {
          return [
            'first_name'        => 'required|string|max:191',
            'last_name'         => 'required|string|max:191',
            'email'             => 'required|email',
            'password'          => 'required',
            'address'           => 'sometimes|required|string|max:191',
            'phone'             => 'required|numeric',
            'email_verified_at' => '',
            'last_login_at'     => '',
            'gender'            => 'required',
            'status'            => '',
            'role_id'           => 'required|exists:roles,id',
          ];
    }

    public function getUpdateRules()
    {
        return [
            'first_name'        => 'sometimes|required|string|max:191',
            'last_name'         => 'sometimes|required|string|max:191',
            'email'             => 'sometimes|required|email',
            'password'          => 'sometimes|required',
            'address'           => 'sometimes|required|string|max:191',
            'phone'             => 'sometimes|required|numeric',
            'email_verified_at' => '',
            'last_login_at'     => '',
            'gender'            => 'sometimes|required',
            'status'            => '',
            'role_id'           => 'sometimes|required|exists:roles,id',
          ];
    }
}
