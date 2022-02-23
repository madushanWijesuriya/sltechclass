<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    protected $fillable = [
        'topic',
        'message',
        'group_id',
        'user_id'
    ];
    protected $casts = [
        'group_id' => 'json',
        'user_id' => 'json',
    ];

}
