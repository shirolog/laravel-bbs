<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;

    protected $fillable = [

        'user_id',
        'title',
        'content',
    ];

    //userとのリレーション関係
    public function user(){

        return $this->belongsTo(User::class);
    }

    //repliesとのリレーション関係
    public function replies(){

        return $this->hasMany(Reply::class);
    }
}
