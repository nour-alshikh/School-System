<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'section' => $this->section->name,
            'teacher' => $this->teacher->name,
            'student' => $this->student->name,
            'date' => $this->attendance_date,
            'status' => $this->attendance_status == 0 ? "Absent" : "Present",
        ];
    }
}
