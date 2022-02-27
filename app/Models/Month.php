<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Month extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'fee',
        'classe_id',
        'start_at',
        'end_at'
    ];
    public function classe(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Classe::class);
    }
    public function videos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Video::class);
    }
    public function quizzes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Quiz::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class,'student_months','month_id','user_id');
    }
    public function payment(){
        return $this->hasMany(Payment::class,'month_id','id');
    }
    public function isPaid(){
        return $this->payment()->where('user_id',Auth::user()->id)->exists();
    }

}
