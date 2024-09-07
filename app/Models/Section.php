<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Section extends Model
{

    use HasFactory, HasTranslations;

    public $translatable = ['name'];

    protected $fillable = ['name', 'status', 'class_room_id', 'grade_id'];


    // RELATIONSHIPS
    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'class_room_id');
    }
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class);
    }
}
