<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Competition;
use App\Models\Round;
use App\Models\Player;
use App\Models\MatchModel;
use App\Models\MatchPlayer;

class CompetitionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('newCompetition', ['rounds' => 'ok']);
    }

    public function getAllCompetition()
    {
        $competitions = Competition::with(['rounds'])->get();
        return view('allCompetitions', ['competitions' => $competitions]);
    }

    public function getCompetition($id)
    {
        $competition_id = $id;
        $competition = Competition::with(['rounds'])->where('id', $competition_id)->first();
        foreach ($competition->rounds as $round) {
            $round['matches'] = MatchModel::with(['winner', 'players'])->where('round_id', $round->id)->get();
        }
        return view('oneCompetition', ['competition' => $competition]);
    }

    public function addCompetition(Request $request)
    {
        $inputData = $request->post();
        $competitionName = $inputData['competitionname'];
        $perMatch = floor(count($inputData['contestants']) / (int)$inputData['rounds']);
        $perMatch = $perMatch == 1 ? 2 : $perMatch;
        $matchesNum = floor(count($inputData['contestants']) / $perMatch);
        $contestantsNum = count($inputData['contestants']);
        
        echo($perMatch .'<br>');
        echo($matchesNum);
        $competition = Competition::create([
            'competition_name' => $competitionName,
        ]);
        $rounds = array();
        $players = array();
        

        for ($i = 0; $i < count($inputData['contestants']); $i++) {
            // add player to db
            $players[$i] = Player::create([
                'player_name' => $inputData['contestants'][$i],
            ]);
        }


        // @todo save data to db
        for ($i = 0; $i < (int)$inputData['rounds']; $i++) {
            // Creating rounds
            $rounds[$i] = Round::create([
                'round_name' => 'Round' . $i,
                'competition_id' =>  $competition->id,
            ]);
            // defining the first player for each match
            $first_player = 0;
            $last_player = 0;
            // defining an array of winners
            $winners = array();
            $matches = array();
            $matchPlayers = array();
            
            for ($j = 0; $j < $matchesNum; $j++) {
                // selecting a random winner for each match
                echo($perMatch);
                // add match to db
                $matches[$j] = MatchModel::create([
                    'round_id' => $rounds[$i]->id,
                    'winner_id' => $players[0]->id,
                ]);
                $fpi = 0;
                $lpi = 0;
                for ($z = $first_player; $z < $contestantsNum; $z++) {
                    $fpi = $first_player;
                    // set each player to current match
                    $matchPlayers[$z] = MatchPlayer::create([
                        'player_id' => $players[$z]->id,
                        'match_id' => $matches[$j]->id,
                    ]);
                    $lpi = $z;
                    // break from loop and save current player index at maximum match capacity
                    if ($j != ($matchesNum - 1)) {
                        if (($z + 1) % $perMatch == 0 && $z > 0) {
                            $first_player = $z + 1;
                            break;
                        }
                        if ($z == $perMatch - 1 ) {
                            $first_player = $z + 1;
                        }
                    }
                }
                // adding the winner to winners
                $winner = $players[rand($fpi /* $lpi + 1  - $perMatch */, $lpi )];
                $winners[] = $winner;
                $matches[$j]->update(['winner_id' => $winner->id]); 
            }
             $players = array_reverse($winners);
             $perMatch = 2;
             $contestantsNum = count($players);
             $matchesNum = $contestantsNum / $perMatch;
        }

        // return view('newCompetition', ['rounds' => $matchesNum . ' ' . $perMatch]);
        return redirect('/competitions');
    }
}
