@extends('layouts.app')

@section('hero-bg')
<div id="hero" class="hero-half" data-type="background" data-speed="10">
    <div class="overlay">
        <div class="container hero-holder">
            <div class="row hero-wrapper">
                <div class="col-md-8 col-md-offset-2">
                    <div class="hero-top">
                        <span>{{ $league->name }}</span>
                    </div>
                    <div class="hero-header">
                        <h1 id="league-title">{{ $match->course->name }}</h1>
                    </div>
                    <div class="hero-sub">
                        
                            <a href="#Standings">{{ date('M d, Y', strtotime($match->date)) }}</a>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('sub-nav')
    @include('nav.subnav_only_title')

    @include('nav.subnav_admin')
@endsection

@section('content')

<div class="container">
    @if((Auth::id() == $league->ownerID) && $match->status != "completed")
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div id="Standings" class="panel panel-default panel-borderless">
                    <div class="panel-heading">
                        <h2 class="panel-title"><span>Admin Panel</span></h2>
                    </div>
                    <div class="panel-body">
                        <div class="panel-text">
                            You signed up for it... fill out all the information below and finalize the round.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row wt-admin-container" style="text-align:center;">
            <div class="col-md-3">
                <a class="wt-admin wt-admin-scores" href="/match/{{ $match->id }}/addscores">Add Scores</a>
                    <span>First add the round's scores for each golfer</span>
            </div>
            <div class="col-md-3">
                <a id="btn-add" name="btn-add" class="wt-admin wt-admin-achievement" href="/match/{{ $match->id }}/addscores">Add Achievement</a>
                    <span>Next add any achievements that were earned</span>
            </div>
            <div class="col-md-3">
                <a id="btn-match" name="btn-match" class="wt-admin wt-admin-points" href="/match/{{ $match->id }}/addscores">Assign Match Points</a>
                    <span>Then assign the winners for the round</span>
            </div>
            <div class="col-md-3">
                <a class="wt-admin wt-admin-finalize" href="/match/{{ $match->id }}/finalize">Finalize Round</a>
                    <span>Finally, close out the round</span>
            </div>
        </div>                       
    @endif

    @if($match->status == "completed" && count($winners) > 0)
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div id="Standings" class="panel panel-default panel-borderless">
                    <div class="panel-heading">
                        <h2 class="panel-title"><span>Match Winners</span></h2>
                    </div>
                    <div class="panel-body">
                        <div class="panel-text">
                            Factoring in match points and achievement points... here are your champions!
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
        @foreach($winners as $winner)
        <div class="col-md-4">
            <div class="panel-body standings-holder">
                <figure class="standings-photo">
                    <img src="{{ $winner->player->image }}" alt="standings image" style="display:block;" />
                    <div class="score-total">
                        <span>{{ $winner->match_points_earned + $winner->achievement_points_earned }}</span>
                    </div>
                    <figcaption class="standings-description">
                        <h3 class="standings-name">{{ $winner->player->firstName }} {{ $winner->player->lastName }}</h3>
                        <div class="standings-points">
                            <span>Match: {{ $winner->match_points_earned }}</span>
                            <span>Achievement: {{ $winner->achievement_points_earned }}</span>
                        </div>
                    </figcaption>
                </figure>
            </div>
        </div>
        @endforeach
        </div>
    @endif


    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div id="Standings" class="panel panel-default panel-borderless">
                <div class="panel-heading">
                    <h2 class="panel-title"><span>Match Scores</span></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default panel-borderless">

                    @if($holes)
                        <div class="table-responsive">
                            <table class="table table-hover score-table">
                                <thead class="holes-row">
                                    <th class="text-left">Hole</th>
                                    @foreach($holes as $hole)
                                        <th>{{ $hole->match_hole_number }}</th>
                                    @endforeach
                                    <th>Total</th>
                                </thead>
                                <thead class="yards-row">
                                    <th class="text-left">Yards</th>
                                    @foreach($holes as $hole)
                                        <th>{{ $hole->hole->yards }}</th>
                                    @endforeach
                                    <th>{{ $totalYards }}</th>
                                </thead>
                                <thead class="par-row">
                                    <th class="text-left">Par</th>
                                    @foreach($holes as $hole)
                                        <th>{{ $hole->hole->par }}</th>
                                    @endforeach
                                    <th>{{ $totalPar }}</th>
                                </thead>

                                @foreach($players as $player)
                                    <tr>
                                        <td class="text-left">
                                            {{ $player->firstName }} {{ $player->lastName }}
                                        </td>
                                        @foreach($player->score as $pscore)
                                            <td>{{ $pscore }}</td>
                                        @endforeach
                                        <td><b>{{ $player->totalScore }}</b></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@if(Auth::id() == $league->ownerID)
<!-- Modal (Pop up when add scores button is clicked) -->
<div class="modal fade" id="mpModal" tabindex="-1" role="dialog" aria-labelledby="mpModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="mpModalLabel">Assign Match Points</h4>
            </div>
            <div class="modal-body">
                <form id="frmAssignPoints" name="frmAssignPoints" class="form-horizontal" novalidate="">
                    <input type="hidden" id="league_id" name="league_id" value="{{ $league->id }}">
                    <input type="hidden" id="match_id" name="match_id" value="{{ $match->id }}">
                    <div class="form-group error">
                        <label for="inputTask" class="col-sm-3 control-label">Player</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="player_id" id="player_id">
                                <option value=""></option>
                                @foreach($league->players as $player)
                                    <option value="{{ $player->id }}">{{ $player->firstName }}</option>
                                @endforeach 
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Points</label>
                        <div class="col-sm-9">
                            <input class="form-control" name="value" id="value" type="text">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-match-save" value="add">Save changes</button>
                <input type="hidden" id="task_id" name="task_id" value="0">
            </div>
        </div>
    </div>
</div>


<!-- Modal (Pop up when add scores button is clicked) -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Achievement</h4>
            </div>
            <div class="modal-body">
                <form id="frmTasks" name="frmTasks" class="form-horizontal" novalidate="">
                    <input type="hidden" id="league_id" name="league_id" value="{{ $league->id }}">
                    <input type="hidden" id="match_id" name="match_id" value="{{ $match->id }}">
                    <div class="form-group error">
                        <label for="inputTask" class="col-sm-3 control-label">Player</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="achievement_player_id" id="achievement_player_id">
                                <option value=""></option>
                                @foreach($league->players as $player)
                                    <option value="{{ $player->id }}">{{ $player->firstName }}</option>
                                @endforeach 
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Achievement</label>
                        <div class="col-sm-9">                        
                            <select class="form-control" name="achievement_id" id="achievement_id">
                                <option value=""></option>
                                @foreach($league->achievements as $achievement)
                                    <option value="{{ $achievement->id }}">{{ $achievement->name }}</option>
                                @endforeach 
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Hole</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="match_hole_id" id="match_hole_id">
                                <option value=""></option>
                                @foreach($match->matchHoles as $hole)
                                    <option value="{{ $hole->id }}">{{ $hole->match_hole_number }}</option>
                                @endforeach 
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-save" value="add">Save changes</button>
                <input type="hidden" id="task_id" name="task_id" value="0">
            </div>
        </div>
    </div>
</div>
@endif

@endsection