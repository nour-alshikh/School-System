<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
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
            'invoice_date' => $this->invoice_date,
            'fee' => $this->fee->name,
            'amount' => $this->amount,
            'grade' => $this->grade->name,
            'class_room' => $this->classRoom->name,
            'description' => $this->description,
        ];
    }
}
