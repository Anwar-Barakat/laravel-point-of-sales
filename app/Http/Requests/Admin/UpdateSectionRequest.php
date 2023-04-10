<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSectionRequest extends FormRequest
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
            'name_ar'       => ['required', 'min:3',  'regex:/^[\pL\s\-]+$/u', 'unique:sections,name->ar,' . $this->section->id],
            'name_en'       => ['required', 'min:3',  'regex:/^[\pL\s\-]+$/u', 'unique:sections,name->en,' . $this->section->id],
            'is_active'     => ['required', 'boolean'],
            'section_id'    => ['required', 'integer']
        ];
    }
}
