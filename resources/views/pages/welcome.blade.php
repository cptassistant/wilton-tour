@extends('layouts.app')

@section('hero-bg')
<div id="hero" class="hero-full" data-type="background" data-speed="10">
    <div class="overlay">
        <div class="container hero-holder">
            <div class="row hero-wrapper">
                <div class="col-md-12">
                    <div class="hero-top">
                        <span>Golf Leagues for everyone</span>
                    </div>
                    <div class="hero-header">
                        <h1>The Wilton <span>Tour</span></h1>
                    </div>
                    <div class="hero-sub">
                        <a href="#learn-more">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="learn-more" class="panel panel-default panel-borderless">
                <div class="panel-heading">
                    <h2 class="panel-title"><span>Welcome</span></h2>
                </div>

                <div class="panel-body" style='height:2000px;'>
                    Tossing some basic info about the website here... for now just login and go to your profile and league page.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
