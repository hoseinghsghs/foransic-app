<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $table = "sections";
    protected $guarded = [];

    public function dossiers()
    {
        return $this->hasMany(Dossier::class, 'section_id');
    }
}
