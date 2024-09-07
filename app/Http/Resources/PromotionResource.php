<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PromotionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'Student' => $this->student->name,
            'grades' => [
                'from grade' => $this->f_grade->name,
                'to grade' => $this->t_grade->name,

            ],
            'classrooms' => [
                'from classroom' => $this->f_class_room->name,
                'to classroom' => $this->t_class_room->name,

            ],
            'sections' => [
                'from section' => $this->f_section->name,
                'to section' => $this->t_section->name,
            ],
            'academic year' => [
                'from' => $this->from_academic_year,
                'to' => $this->to_academic_year,
            ],
        ];
    }
}
