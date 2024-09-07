<?php

namespace App\Http\Requests\Sections;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'data' => "array|required",
            'data.*.name' => "array|required",
            'data.*.name.*' => "string|required",
            'data.*.grade_id' => "required|string|exists:grades,id",
            'data.*.class_room_id' => "required|string|exists:class_rooms,id",
        ];
    }
}
