<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'grade' => $this->grade->name,
            'classroom' => $this->class_room->name,
            'section' => $this->section->name,
            'teacher' => $this->teacher->name,
        ];
    }
}
