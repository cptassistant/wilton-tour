@extends('layouts.app')

@section('hero-bg')
<div id="hero" class="hero-small" data-type="background" data-speed="10">
    <div class="overlay">
        <div class="container hero-holder">
            <div class="row hero-wrapper">
                <div class="col-md-8 col-md-offset-2">
                    <div class="hero-header">
                        <h1 id="league-title">{{ $league->name }}</h1>
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
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div id="Standings" class="panel panel-default panel-borderless">
                <div class="panel-heading">
                    <h2 class="panel-title"><span>{{ $match->course->name }}</span></h2>
                </div>
                <div class="panel-body">
                    <div class="panel-text">
                        {{ date('M d, Y', strtotime($match->date)) }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default panel-borderless">
                <div class="panel-body">
                    <div class="panel-text panel-form">
                        {!! Form::model($match, array('route' => array('match.addscores'))) !!}
                            {!! Form::hidden('match_id', $match->id, ['id' => 'match_id']) !!}
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    {!! Form::label('player', 'Player') !!}
                                </div>
                                <div class="col-sm-6">
                                    <select class="form-control" name="player_id" id="player_id">
                                        <option value=""></option>
                                        @foreach($league->players as $player)
                                            <option value="{{ $player->id }}">{{ $player->firstName }}</option>
                                        @endforeach 
                                    </select>
                                </div>
                            </div>

                            @foreach($match->matchHoles as $matchHole)
                                <div class="form-group row">
                                    <div class="col-sm-2">
                                        Hole #{{ $matchHole->match_hole_number }}
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="{{ $matchHole->id }}" id="{{ $matchHole->id }}">
                                    </div>
                                </div>
                            @endforeach

                            <div class="row">
                                <div class="col-sm-2 col-sm-offset-2">
                                    {!! Form::submit('Create Match', ['class' => 'btn btn-default']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection