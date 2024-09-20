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
        return $this->hasMany(Device::class, 'dossier_id');
    }

    public  function company(){
        return $this->belongsTo(User::class,'user_category_id');
    }

    public function creator(){
        return$this->belongsTo(User::class,'personal_creator_id');
    }

    public function laboratories(){
        return $this->belongsToMany(Laboratory::class);
    }

    public function events()
    {
        return $this->morphMany(Event::class, 'eventable');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
    public function zone()
    {
        return $this->belongsTo(Zone::class, 'zone_id');
    }
}
