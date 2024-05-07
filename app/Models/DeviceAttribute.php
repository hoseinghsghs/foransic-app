<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceAttribute extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = "device_attributes";

    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }
}
