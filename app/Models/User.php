<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function accounts()
    {
        return $this->hasMany(Account::class);
    }

    function investment()
    {
        return $this->hasOneThrough(Investment::class, Account::class);
    }

    function getPictureAttribute()
    {
        $picture = $this->attributes['picture'];

        if($picture)
        {
            return $picture;
        }
        else
        {
            return 'https://ui-avatars.com/api?background=random&name='. $this->attributes['fullname'];
        }
    }
}
