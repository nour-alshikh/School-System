<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Fee extends Model
{
    use
        HasFactory,
        HasTranslations;

    public $translatable = ['name'];

    protected $guarded = ['id'];


    // RELATIONSHIPS
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class);
    }
}
