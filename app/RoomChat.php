<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomChat extends Model
{
    protected $fillable = ['id_room', 'id_user_create_room'];
}
