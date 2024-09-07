<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FatherInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'job' => $this->job,
            'phone' => $this->phone,
            'national_id' => $this->national_id,
            'passport_id' => $this->passport_id,
            'blood_type' => $this->blood_type->name,
            'nationality' => $this->nationality->name,
            'religion' => $this->religion->name,
            'address' => $this->address,
        ];
    }
}
