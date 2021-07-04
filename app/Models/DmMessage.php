<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DmMessage extends Model
{
    protected $fillable = [
        'id', 'send_date', 'to_user', 'from_user', 'msg', 'delete_flg', 'created_at', 'updated_at'
    ];

    protected $table = 'DmMessages';
}
