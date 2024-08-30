<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Verta;

class Device extends Model
{
    use HasFactory;

    protected $table = "devices";
    protected $guarded = [];

    public function images()
    {
        return $this->hasMany(DeviceImage::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function attributes()
    {
        return $this->hasMany(DeviceAttribute::class);
    }
        public function dossier()
    {
        return $this->belongsTo(Dossier::class);
    }

    public function actions()
    {
        return $this->hasMany(Action::class);
    }

    public function laboratory(){
        return $this->belongsTo(Laboratory::class,'laboratory_id');
    }

    public function events()
    {
        return $this->morphMany(Event::class, 'eventable');
    }

    public function scopeGetData($query, $month, $status)
    {
        $v = verta()->startMonth()->subMonth($month - 1);
        $date = verta()->jalaliToGregorian($v->year, $v->month, $v->day);
        return $query->where('created_at', '>', Carbon::create($date[0], $date[1], $date[2], 0, 0, 0))
            ->where('status', $status)
            ->get();
    }
}
