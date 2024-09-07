<?php

namespace App\Http\Requests\Sections;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name.*" => "string|required",
            "status" => "required|boolean",
            "grade_id" => "required|string|exists:grades,id",
            "class_room_id" => "required|exists:class_rooms,id",
            "teacher_ids" => "required|array",
            "teacher_ids.*" => "required|string|exists:teachers,id",
        ];
    }
}
