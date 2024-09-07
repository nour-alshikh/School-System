<?php

namespace App\Http\Requests\ClassRoom;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassRoomRequest extends FormRequest
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
            'data' => 'required|array',
            'data.*.name' => 'required|array', // Ensure 'name' is an array of translations
            'data.*.name.*' => 'required|string', // Each translation should be a string
            'data.*.grade_id' => 'required|string',
        ];
    }
}
