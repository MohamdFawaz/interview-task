<?php

namespace App\Models;

use Faker\Provider\Image;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\File;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name','country_code','phone_number','gender','birthdate','avatar', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function setAvatarAttribute($image)
    {
        try {
            $filename = time() . '.' . $image->getClientOriginalExtension();
            File::move($image,public_path('/images/'.$filename));
            $this->attributes['avatar'] = $filename;
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function getFirstNameAttribute($name)
    {
        return ucwords($name);
    }

    public function getLastNameAttribute($name)
    {
        return ucwords($name);
    }
}
