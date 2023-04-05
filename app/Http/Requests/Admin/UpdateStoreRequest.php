<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStoreRequest extends FormRequest
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
            'name_ar'   => ['required', 'string', 'min:3'],
            'name_en'   => ['required', 'string', 'min:3'],
            'address'   => ['required', 'string', 'min:10'],
            'mobile'    => ['required', 'min:10', 'max:10'],
            'is_active' => ['required', 'boolean', 'between:0,999999']
        ];
    }
}
