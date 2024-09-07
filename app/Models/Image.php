<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the parent imageable model (post or video).
     */
    public function imageable()
    {
        return $this->morphTo();
    }
}
