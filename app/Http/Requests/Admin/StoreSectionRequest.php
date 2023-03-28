<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreSectionRequest extends FormRequest
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
            'name_ar'       => ['required', 'min:3', 'unique:sections,name->ar', 'regex:/^[\pL\s\-]+$/u'],
            'name_en'       => ['required', 'min:3', 'unique:sections,name->en', 'regex:/^[\pL\s\-]+$/u'],
        ];
    }
}
