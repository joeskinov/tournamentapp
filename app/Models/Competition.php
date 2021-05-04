<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'competition_name',
    ];
    public function rounds()
    {
        return $this->hasMany('App\Models\Round');
    }
    public function matches()
    {
        return $this->hasManyThrough('App\Models\MatchModel', 'App\Models\Round');
    }
}
