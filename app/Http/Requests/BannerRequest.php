<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
            'updateStatus'   =>  $this->getUpdateStatusRules(),
        };
    }

    public function getCreateRules()
    {
          return [
            'start_date'         => 'required|date',
            'end_date'           => 'required|date',
            'is_active'          => '',
            'banner_category_id' => 'required|exists:banner_categories,id',
            'vendor_id'          => 'sometimes|exists:vendors,id',
            'image'              => 'sometimes|required|image',
          ];
    }

    public function getUpdateRules()
    {
          return [
            'start_date'         => 'sometimes|required|date',
            'end_date'           => 'sometimes|required|date',
            'is_active'          => '',
            'banner_category_id' => 'sometimes|required|exists:banner_categories,id',
            'vendor_id'          => 'sometimes|required|exists:vendors,id',
            'image'              => 'sometimes|required|image',
          ];
    }
    public function getUpdateStatusRules()
    {
          return [
            'is_active'          => 'required',
          ];
    }
}
