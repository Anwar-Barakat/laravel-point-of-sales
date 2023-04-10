<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreVendorCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name_ar'       => ['required', 'min:3', 'unique:vendor_categories,name->ar', 'regex:/^[\pL\s\-]+$/u'],
            'name_en'       => ['required', 'min:3', 'unique:vendor_categories,name->en', 'regex:/^[\pL\s\-]+$/u'],
            'is_active'     => ['required', 'boolean'],
            'section_id'    => ['required', 'integer']
        ];
    }
}
