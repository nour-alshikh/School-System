<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GuardianResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,

            'father_info' => new FatherInfoResource($this->father_info),
            'mother_info' => new MotherInfoResource($this->mother_info)
        ];
    }
}
