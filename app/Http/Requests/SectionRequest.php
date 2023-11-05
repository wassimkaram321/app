<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
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
            'name'               => 'required|string|max:191',
            'space'              => 'sometimes|required|numeric',
            'position'           => 'sometimes|required|string|max:191',
            'space_id'           => 'sometimes|required|exists:spaces,id',
            'vendor_category_id' => 'required|exists:vendor_categories,id',
            'is_active'          => 'sometimes|required|boolean',
          ];
    }

    public function getUpdateRules()
    {
        return [
            'name'               => 'sometimes|required|string|max:191',
            'space'              => 'sometimes|required|numeric',
            'position'           => 'sometimes|required|string|max:191',
            'space_id'           => 'sometimes|required|exists:spaces,id',
            'vendor_category_id' => 'sometimes|required|exists:vendor_categories,id',
            'is_active'          => 'sometimes|required|boolean',
          ];
    }
}
