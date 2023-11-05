<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MediaRequest extends FormRequest
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
            'model_id'        => '',
            'model_class'     => ['required', new \App\Rules\ValidModelClass],
            'image'           => '',
            'collection_name' => '',
          ];
    }

    public function getUpdateRules()
    {
        return [
            'model'           => '',
            'collection_name' => '',
            'name'            => '',
            'file_name'       => '',
          ];
    }
}
