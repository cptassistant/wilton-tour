<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\League;
use App\Course;
use DB;
use App\Match;
use App\MatchStat;
use App\MatchWinner;
use App\Player;
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
        // Get a player count for the league
        $league->count = $league->players()->count();

        // Calculate league standings
        $standings = $league->players()->get();

        foreach($standings as $player)
        {
            $player->match_score = MatchStat::
                join('matches', 'match_stats.match_id', '=', 'matches.id')->
                where('player_id', $player->id)->
                where('league_id', $league->id)->
                sum('match_points_earned');

            $player->achievement_score = MatchStat::
                join('matches', 'match_stats.match_id', '=', 'matches.id')->
                where('player_id', $player->id)->
                where('league_id', $league->id)->
                sum('achievement_points_earned');

            $player->total_score = $player->match_score + $player->achievement_score;
        }

        $standings = $standings->sortByDesc('total_score');

        // Get a list of matches and add in winner field
        $matches = Match::
            where('league_id', $league->id)->
            get()->
            sortByDesc('date');

        foreach($matches as $match)
        {
            if ($match->matchWinners->count() > 0)
            {
                $match->winner = $match->matchWinners->first()->player->firstName . " " . $match->matchWinners->first()->player->lastName;
            }
            else
            {
                $match->winner = "";
            }
        }

        // Get a list of courses
        $courses = Course::
            join('matches', 'courses.id', '=', 'matches.course_id')->
            select('courses.id', 'courses.name', 'courses.image', 'courses.city', 'courses.state')->
            where('league_id', '=', $league->id)->
            distinct()->
            get()->
            sortBy('name');

        // Get the most played course
        $league->mostCourse = Course::
            join('matches', 'courses.id', '=', 'matches.course_id')->
            select('courses.name', DB::raw('COUNT(courses.id) as numPlayed'))->
            where('league_id', $league->id)->
            groupBy('courses.id', 'courses.name')->
            get()->
            sortByDesc('numPlayed')->
            first();

        // Geet the last played match and calculate random stats
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

        $lastOutting = array('winner' => $lastMatch->matchWinners->first()->player->firstName . " " . $lastMatch->matchWinners->first()->player->lastName,
                             'course' => $lastMatch->course->name,
                             'city' => $lastMatch->course->city . ", " . $lastMatch->course->state,
                             'players' => $lastMatch->number_players,
                             'yards' => round($lastMatchScores->where('id', $lastMatchScores->first()->id)->sum('yards')*1.1),
                             'swings' => $lastMatch->matchStats->sum('total_score'),
                             'pars' => $par);

        // Get Random Stats (might want to refactor this somehow so its not pulling so many DB queries)
        $mostWins = MatchWinner::
            join('matches', 'match_winners.match_id', '=', 'matches.id')->
            join('players', 'match_winners.player_id', '=', 'players.id')->
            select('players.firstName', 'players.lastName', DB::raw('COUNT(match_winners.id) as wins'))->
            where('matches.league_id', '=', $league->id)->
            groupBy('players.firstName', 'players.lastName')->
            first();

        $mostSwings = MatchStat::
            join('matches', 'match_stats.match_id', '=', 'matches.id')->
            join('players', 'match_stats.match_id', '=', 'matches.id')->
            select('players.firstName', 'players.lastName', DB::raw('SUM(total_score) as swings'))->
            where('matches.league_id', '=', $league->id)->
            groupBy('players.firstName', 'players.lastName')->
            get()->
            sortBy('swings')->
            first();

        $best9 = MatchStat::
            join('matches', 'match_stats.match_id', '=', 'matches.id')->
            leftjoin('players', 'match_stats.player_id', '=', 'players.id')->
            join('courses', 'matches.course_id', '=', 'courses.id')->
            select('players.firstName', 'players.lastName', 'total_score')->
            where('matches.league_id', '=', $league->id)->
            where('matches.holes_played', '=', 9)->
            where('total_score', '>', 0)->
            where('courses.courseType', '!=', 'Executive')->
            whereNotNull('total_score')->
            get();

        $best18 = MatchStat::
            join('matches', 'match_stats.match_id', '=', 'matches.id')->
            leftjoin('players', 'match_stats.player_id', '=', 'players.id')->
            join('courses', 'matches.course_id', '=', 'courses.id')->
            select('players.firstName', 'players.lastName', 'total_score')->
            where('matches.league_id', '=', $league->id)->
            where('matches.holes_played', '=', 18)->
            where('total_score', '>', 0)->
            whereNotNull('total_score')->
            where('courses.courseType', '!=', 'Executive')->
            get()->
            sortBy('total_score')->
            first();

        $randomStats = array('mostWinsNum' => $mostWins->wins,
                             'mostWinsPlayer' => $mostWins->firstName . " " . $mostWins->lastName,
                             'mostSwingsNum' => $mostSwings->swings,
                             'mostSwingsPlayer' => $mostSwings->firstName . " " . $mostSwings->lastName,
                             'best9Score' => $best9->sortBy('total_score')->first()->total_score,
                             'best9Player' => $best9->sortBy('total_score')->first()->firstName . " " . $best9->sortBy('total_score')->first()->lastName,
                             'best18Score' => (!$best18) ? $best9->sortByDesc('total_score')->first()->total_score : $best18->total_score,
                             'best18Player' => (!$best18) ? $best9->sortByDesc('total_score')->first()->firstName . " " . $best9->sortByDesc('total_score')->first()->lastName : $best18->firstName . " " . $best18->lastName,
                             'best18Text' => (!$best18) ? 'Worst 9 Holes' : 'Best 18 Holes');

    	return view('league.show', compact('league', 'standings', 'matches', 'courses', 'lastOutting', 'randomStats'));
    }
}
