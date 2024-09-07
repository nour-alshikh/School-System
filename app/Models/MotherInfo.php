<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class MotherInfo extends Model
{
    use
        HasFactory,
        HasTranslations;

    public $translatable = ['job', 'name'];

    public $guarded = ['id'];

    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }
    public function religion()
    {
        return $this->belongsTo(Religion::class);
    }
    public function blood_type()
    {
        return $this->belongsTo(BloodType::class);
    }
}
