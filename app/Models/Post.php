<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $with = ['user', 'userUpdate'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_user_id');
    }
    public function userUpdate()
    {
        return $this->belongsTo(User::class, 'updated_user_id');
    }
}
