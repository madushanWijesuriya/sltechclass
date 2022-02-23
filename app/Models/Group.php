<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
    ];
    public function users(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class,'group_id','id')->where('type','student');
    }
    public function classes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Classe::class);
    }

}
