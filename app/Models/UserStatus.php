<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    protected $fillable  = ['activated','user_id'];

    protected $table = 'user_status';

    protected $hidden = ['created_at','updated_at'];
}
