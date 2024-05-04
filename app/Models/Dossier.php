<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dossier extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function devices()
    {
        return $this->hasMany(Device::class, 'device_id');
    }

    public  function company(){
        return $this->belongsTo(User::class,'user_category_id');
    }
}
