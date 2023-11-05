<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryRequest extends FormRequest
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
            'name'      => 'required|string|max:191',
            'is_active' => 'sometimes|required|boolean'
          ];
    }

    public function getUpdateRules()
    {
        return [
            'name'      => 'sometimes|required|string|max:191',
            'is_active' => 'sometimes|required|boolean'
          ];
    }
}
