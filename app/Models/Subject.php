<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Subject extends Model
{
    use
        HasFactory,
        HasTranslations;

    public $translatable = ['name'];

    protected $guarded = ['id'];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
    public function class_room()
    {
        return $this->belongsTo(ClassRoom::class);
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
