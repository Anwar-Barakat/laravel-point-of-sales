<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUnitRequest extends FormRequest
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
            'name_ar'   => ['required', 'min:3'],
            'name_en'   => ['required', 'min:3'],
            'is_active' => ['required', 'boolean'],
            'status'    => ['required', 'in:retail,wholesale']
        ];
    }
}
