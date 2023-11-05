<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeatureRequest extends FormRequest
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
            'title' => '',
            'content' => '',
            'is_active' => '',
            'featureable_id' => '',
            'featureable_type' => ''
          ];
    }

    public function getUpdateRules()
    {
          return [
            'title' => '',
            'content' => '',
            'is_active' => '',
            'featureable_id' => '',
            'featureable_type' => ''
          ];
    }
}
