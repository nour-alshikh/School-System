<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use
        HasFactory,
        HasTranslations,
        SoftDeletes;

    public $translatable = ['name'];
    protected $guarded = ['id'];

    // RELATIONSHIPS
    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class);
    }
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    public function bloodType()
    {
        return $this->belongsTo(BloodType::class);
    }
    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }
    public function guardian()
    {
        return $this->belongsTo(Guardian::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    public function student_account()
    {
        return $this->hasMany(StudentAccount::class);
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }
}
