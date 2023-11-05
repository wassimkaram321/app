<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
             default   =>  $this->getUpdateRules(),
        };
    }

    public function getCreateRules()
    {
          return [
            'user_id'      => '',
            'total_amount' => '',
            'status'       => '',
            'cart_id'      => 'required|exists:carts,id',
          ];
    }

    public function getUpdateRules()
    {
          return [
            'user_id'      => '',
            'total_amount' => '',
            'status'       => '',
          ];
    }
}
