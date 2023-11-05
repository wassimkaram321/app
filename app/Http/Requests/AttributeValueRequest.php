<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeValueRequest extends FormRequest
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
            'attribute_id' => 'required|integer|exists:attributes,id',
            'value'        => 'required|string|max:191'
          ];
    }

    public function getUpdateRules()
    {
        return [
            'attribute_id' => 'sometimes|required|integer|exists:attributes,id',
            'value'        => 'sometimes|required|string|max:191'
          ];
    }
}
