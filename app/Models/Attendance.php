<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
    public function class_room()
    {
        return $this->belongsTo(ClassRoom::class);
    }
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
