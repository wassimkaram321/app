<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerCategoryRequest extends FormRequest
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
            'create'         =>  $this->getCreateRules(),
            'update'         =>  $this->getUpdateRules(),
            'updateStatus'   =>  $this->getUpdateStatusRules(),
        };
    }

    public function getCreateRules()
    {
          return [
            'type'      => 'required|max:191',
            'is_active' => ''
          ];
    }

    public function getUpdateRules()
    {
          return [
            'type'      => 'sometimes|required|max:191',
            'is_active' => ''
          ];
    }
    public function getUpdateStatusRules()
    {
          return [
            'is_active' => 'required|boolean'
          ];
    }
   
}
