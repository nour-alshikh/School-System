<?php

namespace App\Http\Requests\Guardian;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGuardianRequest extends FormRequest
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
            'email' => "email|required|unique:guardians,email," . $this->id,
            'f_name' => "array|required",
            'f_name.*' => "string",
            'password' => "required",
            'f_national_id' => "required|string|min:10|max:10|unique:father_infos,national_id," . $this->id,
            'f_passport_id' =>
            "required|string|min:10|max:10|unique:father_infos,passport_id," . $this->id,
            'f_phone' => "string|required",
            'f_address' => "string|required",
            'f_job' => "array|required",
            'f_job.*' => "string",
            'f_blood_type_id' => "required|string|exists:blood_types,id",
            'f_nationality_id' => "required|string|exists:nationalities,id",
            'f_religion_id' => "required|string|exists:religions,id",


            'm_name' => "array|required",
            'm_name.*' => "string",
            'm_national_id' =>
            "required|string|min:10|max:10|unique:mother_infos,national_id," . $this->id,
            'm_passport_id' =>
            "required|string|min:10|max:10|unique:mother_infos,passport_id," . $this->id,
            'm_phone' => "string|required",
            'm_address' => "string|required",
            'm_job' => "array|required",
            'm_job.*' => "string",
            'm_blood_type_id' => "required|string|exists:blood_types,id",
            'm_nationality_id' => "required|string|exists:nationalities,id",
            'm_religion_id' => "required|string|exists:religions,id",
        ];
    }
}
