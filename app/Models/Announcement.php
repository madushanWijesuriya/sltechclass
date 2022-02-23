<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Announcement extends Model
{
    use HasFactory,SoftDeletes;
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
