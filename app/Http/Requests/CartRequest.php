<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
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
            'user_id'            => '',
            'items'              => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity'   => 'required|integer|min:1'
          ];
    }

    public function getUpdateRules()
    {
        return [
            'user_id'            => '',
            'items'              => 'required|array',
            'items.*.product_id' => 'sometimes|required|exists:products,id',
            'items.*.quantity'   => 'sometimes|required|integer|min:1'
          ];
    }
}
