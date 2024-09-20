<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model
{
    use HasFactory;
    protected $table = "laboratories";
    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function crack()
    {
        return $this->hasOne(Crack::class);
    }
    public function dossiers()
    {
        return $this->belongsToMany(Dossier::class);
    }
}
