<?php

namespace App\Http\Requests\Grades;

use Illuminate\Foundation\Http\FormRequest;

class StoreGradeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name_ar' => "required|unique:grades,name->ar",
            'name_en' => "required|unique:grades,name->en",

        ];
    }

    public function messages(): array
    {
        return [
            'name_en.required' => trans('validation.required'),
            'name_en.unique' => trans('validation.unique'),
            'name_ar.required' => trans('validation.required'),
            'name_ar.unique' => trans('validation.unique'),
        ];
    }

    public function attributes(): array
    {
        return [
            'name_ar' => trans('attributes.name_ar'),
            'name_en' => trans('attributes.name_en'),
            'notes' => trans('attributes.notes'),
        ];
    }
}
