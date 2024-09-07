<?php

namespace App\Http\Requests\Fees;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFeesRequest extends FormRequest
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
            'name_ar' => "nullable",
            'name_en' => "nullable",
            'amount' => "nullable|numeric",
            'grade_id' => "nullable|exists:grades,id",
            'class_room_id' => "nullable|exists:class_rooms,id",
            'notes' => "nullable",
            'year' => "nullable",
        ];
    }
}
