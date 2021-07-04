<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewLike extends Model
{
    protected $fillable = [
        'id', 'user_id', 'favorite_recode', 'delete_flg', 'created_at', 'updated_at'
    ];

    protected $table = 'ReviewLikes';
}
