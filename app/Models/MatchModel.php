<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchModel extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $fillable = [
        'round_id',
        'winner_id',
    ];
    protected $table = 'matches';

    public function round()
    {
        return $this->belongsTo('App\Models\Round');
    }

    public function winner()
    {
        return $this->belongsTo('App\Models\Player', 'winner_id');
    }

    public function matchPlayers()
    {
        return $this->hasMany('App\Models\MatchPlayer');
    }

    public function players()
    {
        return $this->belongsToMany('App\Models\Player', 'matchplayer', 'match_id', 'player_id');
    }
    
}
