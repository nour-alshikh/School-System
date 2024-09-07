<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    // RELATIONSHIPS
    public function father_info()
    {
        return $this->hasOne(FatherInfo::class);
    }
    public function mother_info()
    {
        return $this->hasOne(MotherInfo::class);
    }
    public function attachments()
    {
        return $this->hasMany(GuardiansAttachment::class);
    }
}
