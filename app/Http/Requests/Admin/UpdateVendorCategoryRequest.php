<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVendorCategoryRequest extends FormRequest
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
            'name_ar'       => ['required', 'min:3',  'regex:/^[\pL\s\-]+$/u', 'unique:vendor_categories,name->ar,' . $this->vendor_category->id],
            'name_en'       => ['required', 'min:3',  'regex:/^[\pL\s\-]+$/u', 'unique:vendor_categories,name->en,' . $this->vendor_category->id],
        ];
    }
}