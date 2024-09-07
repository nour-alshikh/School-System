<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class ClassRoom extends Model
{
    use
        HasFactory,
        HasTranslations;

    public $translatable = ['name'];

    protected $fillable = ['name', 'grade_id'];

    // RELATIONSHIPS
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}
