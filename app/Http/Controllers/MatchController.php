<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\League;
use App\Course;
use App\Hole;
use App\Match;
use App\MatchScore;
use App\MatchStat;
use App\Scorecard;
use App\MatchHole;
use App\LeagueAchievement;
use App\MatchAchievement;
use App\MatchWinner;
use App\Achievement;
use App\Http\Requests;
use App\Http\Controllers;

class MatchController extends Controller
{
    public function leagueCreate(League $league)
    {
    	$match = new Match;

    	return view('match.leagueCreate', compact('league', 'match'));
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
    		'league_id' => 'required',
    		'date' => 'required',
    		'course_id' => 'required',
            'scorecard' => 'required'
    	]);

    	$data = $request->only('league_id', 'date', 'course_id', 'scorecard');

        $checked = $request->only('course_holes');
        $numHoles = count($checked['course_holes']);

        // Create new match
 		$match = new Match;

        $match->league_id = $data['league_id'];
        $match->date = $data['date'];
        $match->course_id = $data['course_id'];
        $match->holes_played = $numHoles;

        $match->save();

        // Create Match Holes

        $i = 0;
        while($i < $numHoles)
        {        
            $courseHole = Hole::
                join('scorecards', 'holes.scorecard_id', '=', 'scorecards.id')->
                where('scorecards.id', '=', $data['scorecard'])->
                where('scorecards.course_id', '=', $match->course_id)->
                where('number', $checked['course_holes'][$i])->
                select('holes.id', 'holes.number')->
                first();

            $match_hole = new MatchHole;
            $match_hole->match_id =  $match->id;
            $match_hole->match_hole_number = $courseHole->number;
            $match_hole->hole_id = $courseHole->id;

            $match_hole->save();

            $i++;
        }

    	return redirect()->route('match.show', [$match->id]);
    }

    public function show(Match $match)
    {
    	// Get the league
    	$league = League::
    		find($match->league_id);

    	// Get a list of the players
    	$players = MatchScore::
    		join('players', 'match_scores.player_id', '=', 'players.id')->
    		where('match_id', $match->id)->
    		select('player_id', 'players.firstName', 'players.lastName')->
    		distinct()->
    		get();

    	// Get the holes that were played
        $holes = [];

    	$holes = MatchHole::
                with('hole')->
                where('match_id', $match->id)->
                get();

        $totalYards = 0;
        $totalPar = 0;

        foreach($holes as $hole)
        {
            $totalYards = $totalYards + $hole->hole->yards;
            $totalPar = $totalPar + $hole->hole->par;
        }

    	// Add the hole scores to the player variable for blade loop
    	foreach ($players as $player)
    	{
            $score = [];
            $totalScore = 0;
            $test = "";

            foreach($holes as $hole)
            {
                $holeScore = MatchScore::where('player_id', $player->player_id)->where('match_holes_id', $hole->id)->select('score')->get();

                if($holeScore->isEmpty())
                {
                    $score[] = 'X';
                    $test = "DNF";
                }
                else
                {
                    $score[] = $holeScore['0']['score'];
                    $totalScore = $totalScore + $holeScore['0']['score'];
                }
            }

            $player->score = $score;
            if($test != "DNF")
            {
                $player->totalScore = $totalScore;
            }
            else
            {
                $player->totalScore = "DNF";
            }
    	}
        
    	// Get achievements for the round

    	// Get winners for the round
        if($match->status == "completed")
        {
            $winners = MatchStat::
                with('player')->
                where('match_id', $match->id)->
                where(function ($query) {
                    $query->where('match_points_earned', '>', 0)->
                            orWhere('achievement_points_earned', '>', 0);
                })
                ->orderBy('match_points_earned', 'desc')->get();
        }

    	return view('match.show', compact('match', 'league', 'players', 'holes', 'totalYards', 'totalPar', 'winners'));
    }

    public function addScores(Match $match)
    {
        // Get the league
        $league = League::
            find($match->league_id);

        // Get Match Holes
        $matchHoles = MatchHole::
            where('match_id', $match->id)->
            get();

        return view('match.addscores', compact('match', 'league'));
    }

    public function finalize(Match $match)
    {
        $match->status = "completed";
        $match->save();

        return redirect()->action('MatchController@show', [$match->id]);
    }

    public function postScores(Request $request)
    {
        // Get the match
        $match = Match::
            find($request->only('match_id'))->first();

        $totalScore = 0;
        $count = 0;

        foreach($match->matchHoles as $matchHole)
        {
            if($request->only($matchHole->id)[$matchHole->id] > 0)
            {
                $score = new MatchScore;
                $score->player_id =  $request->only('player_id')['player_id'];
                $score->score = $request->only($matchHole->id)[$matchHole->id];
                $score->match_id = $match->id;
                $score->hole_id = $matchHole->hole_id;
                $score->match_holes_id = $matchHole->id;

                $totalScore = $totalScore + $score->score;

                $score->save();
                $count = $count + 1;
            }
        }

        if($count < 9)
        {
            $totalScore = 0;
        }

        $ms = new MatchStat;
        $ms->match_id = $match->id;
        $ms->player_id = $request->only('player_id')['player_id'];
        $ms->total_score = $totalScore;

        $ms->save();

        $match->number_players = $match->number_players + 1;
        $match->save();

        return redirect()->action('MatchController@show', [$match->id]);
    }

    public function postAchievement(Request $request)
    {
        // Validate request
        $this->validate($request, [
            'player_id' => 'required',
            'achievement_id' => 'required',
            'match_hole_id' => 'required'
        ]);

        // Create match achievement record
        $data = $request->only('player_id', 'achievement_id', 'match_hole_id', 'league_id', 'match_id');

        $mhole = MatchHole::find($data['match_hole_id']);

        $machievement = new MatchAchievement;
        $machievement->player_id = $data['player_id'];
        $machievement->match_id = $data['match_id'];
        $machievement->achievement_id = $data['achievement_id'];
        $machievement->hole_id = $mhole->hole_id;

        $machievement->save();

        // Update match stats achievement value
        $mstat = MatchStat::firstOrNew(['match_id' => $machievement->match_id, 'player_id' => $machievement->player_id]);
        $achievementVal = Achievement::find($machievement->achievement_id)->value;
        $mstat->achievement_points_earned = $mstat->achievement_points_earned + $achievementVal;

        $mstat->save();

        return \Response::json($mstat);
    }

    public function assignPoints(Request $request)
    {
        // Validate request
        $this->validate($request, [
            'player_id' => 'required', 
            'value' => 'required|numeric'
        ]);

        // Create match achievement record
        $data = $request->only('player_id', 'match_id', 'value');

        // Update match stats match points value
        $mstat = MatchStat::firstOrNew(['match_id' => $data['match_id'], 'player_id' => $data['player_id']]);
        $mstat->match_points_earned = $data['value'];
        $mstat->save();

        // Update match winners
        $mwinner = MatchWinner::firstOrNew(['match_id' => $data['match_id'], 'player_id' => $data['player_id']]);
        $mwinner->value = $data['value'];
        $mwinner->save();

        return \Response::json($request);
    }

    public function getTees(Course $course)
    {
        $course_id = $course->id;

        $scorecards = Scorecard::where('course_id', $course_id)->get();

        return \Response::json($scorecards);
    }

    public function getHoles(Course $course)
    {
        $holes = $course->numHoles;

        return \Response::json($holes);
    }
}