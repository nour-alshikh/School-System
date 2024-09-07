<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function f_grade()
    {
        return $this->belongsTo(Grade::class, "from_grade");
    }
    public function f_class_room()
    {
        return $this->belongsTo(ClassRoom::class, "from_class_room");
    }
    public function f_section()
    {
        return $this->belongsTo(Section::class, "from_section");
    }
    public function t_grade()
    {
        return $this->belongsTo(Grade::class, "to_grade");
    }
    public function t_class_room()
    {
        return $this->belongsTo(ClassRoom::class, "to_class_room");
    }
    public function t_section()
    {
        return $this->belongsTo(Section::class, "to_section");
    }
}
