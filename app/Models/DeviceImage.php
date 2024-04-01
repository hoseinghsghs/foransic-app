<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DeviceImage
 *
 * @property int $id
 * @property int $product_id
 * @property string $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceImage whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceImage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DeviceImage extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table="device_images";

}
