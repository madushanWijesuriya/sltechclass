<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quiz extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'embed_code',
        'month_id',
        'url',
    ];

    public function month(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Month::class);
    }
}
