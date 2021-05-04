<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matchplayer extends Model
{
    use HasFactory;
    protected $table = 'matchplayer';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'player_id',
        'match_id',
    ];
    public function matches()
    {
        return $this->belongsTo('App\Models\MatchModel');
    }

    public function player()
    {
        return $this->belongsTo('App\Models\Player');
    }
}
