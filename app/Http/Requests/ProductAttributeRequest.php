<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductAttributeRequest extends FormRequest
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
            'attribute_id'   => 'required|exists:attributes,id',
            'product_id'     => 'required|exists:products,id',
            'selected_value' => 'required|exists:product_attributes',
            'quantity'       => 'required',
          ];
    }

    public function getUpdateRules()
    {
        return [
            'attribute_id'   => 'sometimes|required|exists:attributes,id',
            'product_id'     => 'sometimes|required|exists:products,id',
            'selected_value' => 'sometimes|required|exists:product_attributes',
            'quantity'       => 'sometimes|required',
          ];
    }
}
