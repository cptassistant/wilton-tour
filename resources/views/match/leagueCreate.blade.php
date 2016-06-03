@extends('layouts.app')

@section('hero-bg')
<div id="hero" class="hero-half" data-type="background" data-speed="10">
    <div class="overlay">
        <div class="container hero-holder">
            <div class="row hero-wrapper">
                <div class="col-md-8 col-md-offset-2">
                    <div class="hero-top">
                        <span>{{ $league->tagline }}</span>
                    </div>
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
                    <h2 class="panel-title"><span>Create Match</span></h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default panel-borderless">
                <div class="panel-body">
                    <div class="panel-text panel-form">
                        {!! Form::model($match, array('route' => array('match.store'))) !!}
                            {!! Form::hidden('league_id', $league->id, ['id' => 'league_id']) !!}
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    {!! Form::label('league', 'League') !!}
                                </div>
                                <div class="col-sm-6">
                                    {!! Form::text('league', $league->name, ['disabled' => 'disabled', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group row {!! $errors->has('date') ? 'has-error' : '' !!}">
                                <div class="col-sm-2">
                                    {!! Form::label('date', 'Date') !!}
                                </div>
                                <div class="col-sm-6">
                                    {!! Form::date('date', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group row {!! $errors->has('course_id') ? 'has-error' : '' !!}">
                                <div class="col-sm-2">
                                    {!! Form::label('course_id', 'Course') !!}
                                </div>
                                <div class="col-sm-6">
                                    {!! Form::select('course_id', [''=>'']+App\Course::lists('name','id')->all(), null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    {!! Form::label('scorecard_id', 'Tee') !!}
                                </div>
                                <div class="col-sm-6">
                                    <select class="form-control" name="scorecard" id="scorecard">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                   {!! Form::label('holes_played', 'Holes') !!}
                                </div>
                                <div class="col-sm-6" id="holes-list" name="holes-list">
                                    
                                </div>
                            </div>
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