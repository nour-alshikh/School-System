<?php

namespace App\Http\Requests\Grades;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGradeRequest extends FormRequest
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
            'name_ar' => "required",
            'name_en' => "required",
        ];
    }

    // public function messages(): array
    // {
    //     return [
    //         'name_en' => trans('validation.required'),
    //         'name_ar' => trans('validation.required'),
    //     ];
    // }

    public function attributes(): array
    {
        return [
            'name_ar' => trans('attributes.name_ar'),
            'name_en' => trans('attributes.name_en'),
        ];
    }
}
