<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\League;
use App\Course;
use DB;
use App\Match;
use App\MatchWinner;
use App\MatchAchievement;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class LeagueController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['only' => 'index']);
    }

    public function index()
    {
        $leagues = League::paginate(30);

    	return view('league.index', compact('leagues'));
    }

    public function show(League $league)
    {
        $league->count = $league->players()->count();

        // Calculate league standings
        $standings = $league->players()->get();

        foreach($standings as $player)
        {
            $player->match_score = MatchWinner::
                join('matches', 'match_winners.match_id', '=', 'matches.id')
                ->where('player_id', $player->id)
                ->where('league_id', $league->id)
                ->sum('value');

            $player->achievement_score = MatchAchievement::
                join('matches', 'match_achievements.match_id', '=', 'matches.id')
                ->join('achievements', 'match_achievements.achievement_id', '=', 'achievements.id')
                ->where('player_id', $player->id)
                ->where('league_id', $league->id)
                ->sum('value');

            $player->total_score = $player->match_score + $player->achievement_score;
        }

        $standings = $standings->sortByDesc('total_score');

        $matches = Match::where('league_id', $league->id)->get()->sortByDesc('date');

        foreach($matches as $match)
        {
            if ($match->matchScores->first())
            {
                $mp = $match->matchScores->first()->player_id;
                $match->holesPlayed = $match->matchScores()->where('player_id', $mp)->count();  

                $scores = $match->matchScores()->join('players', 'match_scores.player_id', '=', 'players.id')->select('player_id', 'players.firstName', 'players.lastName', DB::raw('SUM(score) as TotalScore'))->groupBy('player_id', 'players.firstName', 'players.lastName')->get();        

                $scores = $scores->sortBy('TotalScore');

                $match_winner = $scores->sortBy('TotalScore')->first();
                $scores->shift();
                $match_second = $scores->sortBy('TotalScore')->first();

                if ($match_winner == $match_second)
                {
                    $match_winner = $match->matchWinners()->get()->sortByDesc('value')->first();                    
                }
            }

            elseif ($match->matchWinners->first())
            {
                $match->winner = $match->matchWinners()->get()->sortByDesc('value')->first();
            }

            $match->winner = $match_winner;
        }

        $courses = Course::join('matches', 'courses.id', '=', 'matches.course_id')->select('courses.id', 'courses.name', 'courses.image', 'courses.city', 'courses.state')->where('league_id', '=', $league->id)->distinct()->get()->sortBy('name');

        $league->mostCourse = Course::join('matches', 'courses.id', '=', 'matches.course_id')->select('courses.name', DB::raw('COUNT(courses.id) as numPlayed'))->where('league_id', $league->id)->groupBy('courses.id', 'courses.name')->get()->sortByDesc('numPlayed')->first();

        $lastMatch = $matches->first();

        $lastMatchScores = $lastMatch
            ->matchScores()
            ->join('holes', 'match_scores.hole_id', '=', 'holes.id')
            ->join('players', 'match_scores.player_id', '=', 'players.id')
            ->select('players.id', 'match_scores.score', 'holes.par', 'holes.yards')
            ->get();

        $par = 0;
        foreach($lastMatchScores as $lastMatchScore)
        {
            if ($lastMatchScore->score <= $lastMatchScore->par)
            {
                $par++;
            }
        }

        $lastOutting = array('winner' => $lastMatch->winner->firstName . " " . $lastMatch->winner->lastName,
                             'course' => $lastMatch->course->name,
                             'city' => $lastMatch->course->city . ", " . $lastMatch->course->state,
                             'players' => $lastMatchScores->groupBy('id')->count(),
                             'yards' => round($lastMatchScores->where('id', $lastMatchScores->first()->id)->sum('yards')*1.1),
                             'swings' => $lastMatchScores->sum('score'),
                             'pars' => $par);

    	return view('league.show', compact('league', 'standings', 'matches', 'courses', 'lastOutting'));
    }
}
