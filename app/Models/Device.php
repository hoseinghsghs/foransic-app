<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;
    protected $table = "devices";
    protected $guarded = [];

        public function images()
    {
        return $this->hasMany(DeviceImage::class);
    }
            public function dossier()
    {
        return $this->belongsTo(Dossier::class);
    }
}
