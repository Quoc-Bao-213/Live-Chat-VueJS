<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomChat extends Model
{
    protected $fillable = ['room_name', 'id_room', 'avatar_room', 'id_user_create_room'];
}
