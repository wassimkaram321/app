<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpaceRequest extends FormRequest
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
            'space'     => 'required|numeric',
            'is_active' => 'sometimes|required|boolean',
            'floor_id'  => 'required|exists:floors,id',
          ];
    }

    public function getUpdateRules()
    {
        return [
            'name'      => 'required|string|max:191',
            'space'     => 'required|numeric',
            'is_active' => 'sometimes|required|boolean',
            'floor_id'  => 'required|exists:floors,id',
          ];
    }
}
