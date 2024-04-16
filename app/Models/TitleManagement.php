<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TitleManagement extends Model
{
    use HasFactory;
    protected $table = "title_managements";
    protected $guarded = [];

      public function devices()
    {
        return $this->hasMany(Device::class , 'title_managements_id');
    }
}
