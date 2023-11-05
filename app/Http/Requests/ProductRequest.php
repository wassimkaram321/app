<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name'               => 'required|string|max:191|unique:products,name',
            'description'        => 'required|string',
            'price'              => 'required',
            'slug'               => '',
            'quantity'           => 'required|integer',
            'is_active'          => 'sometimes|required|boolean',
            'is_returnable'      => 'sometimes|required|boolean',
            'is_cancelable'      => 'sometimes|required|boolean',
            'is_replaceable'     => 'sometimes|required|boolean',
            'availability'       => '',
            'vendor_id'          => 'required|integer|exists:vendors,id',
            'categorizable_id'   => 'required|integer',
            'categorizable_type' => 'required|string',
            'commission_id'      => 'required|integer|exists:commissions,id',
            'commission_value'   => 'required|integer',
            'attributes'         => 'sometimes|required|array',
            'features'           => 'sometimes|required|array',
          ];
    }

    public function getUpdateRules()
    {
        return [
            'name'               => 'sometimes|required|string|max:191',
            'description'        => 'sometimes|required|string',
            'price'              => 'sometimes|required',
            'slug'               => '',
            'quantity'           => 'sometimes|required|integer',
            'is_active'          => 'sometimes|required|boolean',
            'is_returnable'      => 'sometimes|required|boolean',
            'is_cancelable'      => 'sometimes|required|boolean',
            'is_replaceable'     => 'sometimes|required|boolean',
            'availability'       => '',
            'vendor_id'          => 'sometimesrequired|integer|exists:vendors,id',
            'categorizable_id'   => 'sometimesrequired|integer',
            'categorizable_type' => 'sometimesrequired|string',
            'commission_id'      => 'sometimesrequired|integer|exists:commissions,id',
            'commission_value'   => 'sometimesrequired|integer',
            'attributes'         => 'sometimes|required|array',
            'features'           => 'sometimes|required|array',
          ];
    }
}
