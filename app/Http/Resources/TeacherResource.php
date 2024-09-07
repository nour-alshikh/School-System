<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'gender'  => $this->gender->name,
            'specialization'  => $this->specialization->name,
            'join_date' => $this->join_date,
            'address' => $this->address,
            // 'sections' => SectionResource::collection($this->sections),
            'sections' => $this->sections,
        ];
    }
}
