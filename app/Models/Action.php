<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;
    protected $table = "actions";
    protected $guarded = [];

        public function user()
    {
        return $this->belongsTo(User::class);
    }

      public function category()
    {
        return $this->belongsTo(ActionCategory::class , 'action_category_id');
    }

        public function attachments()
    {
        return $this->hasMany(ActionAttachment::class);
    }

    public function device()
    {
        return $this->belongsTo(Device::class , 'device_id');
    }
}

