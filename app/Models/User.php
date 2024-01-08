<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected function activeLabel() : Attribute
    {
        return Attribute::make(
            get: function() {
                return $this->attributes['active']
                ?
                '<span class="badge badge-success">Activo</span>'
                :
                '<span class="badge badge-warning">Inactivo</span>'
                ;
            }
        );
    }

    public function imagen() : Attribute
    {
        return Attribute::make(
            get: function() {
                return $this->image 
                ? 
                Storage::url('public/' . $this->image->url) 
                :
                asset('no-image.png');
            }
        );
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
