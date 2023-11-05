<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
            'name'               => 'required|string|max:191',
            'description'        => 'required',
            'slug'               => '',
            'latitude'           => 'sometimes|required|numeric',
            'longitude'          => 'sometimes|required|numeric',
            'address'            => 'sometimes|required',
            'phone'              => 'required|regex:/^\d{10}$/',
            'email'              => 'required|email',
            'is_active'          => '',
            'vendor_category_id' => 'required|exists:vendor_categories,id',
            'city_id'            => 'sometimes|required',
        ];

    }

    public function getUpdateRules()
    {
        return [
            'name'               => 'sometimes|required|string|max:191',
            'description'        => 'sometimes|required',
            'slug'               => '',
            'latitude'           => 'sometimes|required|numeric',
            'longitude'          => 'sometimes|required|numeric',
            'address'            => 'sometimes|required',
            'phone'              => 'sometimes|required|regex:/^\d{10}$/',
            'email'              => 'sometimes|required|email',
            'is_active'          => 'sometimes|required|boolean',
            'vendor_category_id' => 'sometimes|required|exists:vendor_categories,id',
            'city_id'            => 'sometimes|required',
        ];

    }
}
