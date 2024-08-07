<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable , HasRoles, HasApiTokens ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'laboratory_id',
        'password',
        'cellphone',
        'avatar',
        'provider_name',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function events()
    {
        return $this->morphMany(Event::class, 'eventable');
    }

    public function events1()
    {
        return $this->belongsToMany(EventUser::class);
    }

        public function actions()
    {
        return $this->hasMany(Action::class , 'user_id');
    }

    public function laboratory(){
        return $this->belongsTo(Laboratory::class,'laboratory_id');
    }
    public function crack()
    {
        return $this->hasOne(Crack::class, 'user_id');
    }

}
