<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'round_name',
        'competition_id',
    ];
    public function competition()
    {
        return $this->belongsTo('App\Models\Competition');
    }
    public function matches()
    {
        return $this->hasMany('App\Models\MatchModel');
    }
}
