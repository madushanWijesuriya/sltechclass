<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'url'
    ];

    public function months(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Month::class);
    }
}
