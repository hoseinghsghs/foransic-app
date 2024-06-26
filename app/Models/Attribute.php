<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function categories()
    {
        return $this->belongsToMany(Category::class,'attribute_category');
    }
    public function attributeValues()
    {
        return $this->hasMany(DeviceAttribute::class);
    }
}
