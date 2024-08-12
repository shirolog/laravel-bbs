<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = [

        'thread_id',
        'user_id',
        'content',
    ];

    // userとのリレーション関係

    public function user(){

        return $this->belongsTo(User::class);
    }

}
