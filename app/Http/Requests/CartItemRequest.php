<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartItemRequest extends FormRequest
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
            default    =>  $this->getUpdateRules(),
        };
    }

    public function getCreateRules()
    {
          return [
            'cart_id'    => 'required|exists:carts,id',
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|numeric',
          ];
    }

    public function getUpdateRules()
    {
        return [
            'cart_id'    => 'sometimes|required|exists:carts,id',
            'product_id' => 'sometimes|required|exists:products,id',
            'quantity'   => 'sometimes|required|numeric',
          ];
    }
}
