<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRoom extends Model
{
    protected $fillable = ['my_id', 'friend_id', 'room_id'];
}
