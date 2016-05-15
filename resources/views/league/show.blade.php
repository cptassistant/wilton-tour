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
	<ul class="nav navbar-nav navbar-left">
		<li class="slide-in">
			<a href="/league/{{ $league->id }}">
				<img src="{{ $league->logo }}" />
				<div class="sub-nav-league-container">
					<span class="league-name">{{ $league->name }}</span>
					<span class="league-dates">{{ date('M d, Y', strtotime($league->start_date)) }} - {{ date('M d, Y', strtotime($league->end_date)) }}</span>
				</div>
			</a>
		</li>
		<li><a href="#Standings">Standings</a></li>
		<li><a href="#Matches">Match History</a></li>
		@if ($league->is_achievements == true)
			<li><a href="#Achievements">Achievements</a></li>
		@endif
		@if($league->disable_courses == false)
			<li><a href="#Courses">Courses</a></li>
		@endif
		@if($league->disable_rules == false)
			<li><a href="#Rules">Rules</a></li>
		@endif
	</ul>
@endsection


@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div id="Standings" class="panel panel-default panel-borderless">
                <div class="panel-heading">
                    <h2 class="panel-title"><span>The Standings</span></h2>
                </div>

				<div class="panel-body">
					<div class="panel-text">
						{{ $league->standings_blurb }}
					</div>
				</div>
            </div>
        </div>
    </div>

    <div class="row">
    	<div class="panel panel-default panel-borderless">
		<?php $a = 1; ?>

@foreach($standings as $player)

@if($a<=3) <!-- 3 -->
			<div class="col-md-4">
				<div class="panel-body standings-holder">
					<figure class="standings-photo">
						<img src="{{ $player->image }}" alt="standings image" style="display:block;" />
						<div class="score-total">
							<span>{{ $player->total_score }}</span>
						</div>
						<figcaption class="standings-description">
							<h3 class="standings-name">{{ $player->firstName }} {{ $player->lastName }}</h3>
							<div class="standings-points">
								<span>Match: {{ $player->match_score }}</span>
								<span>Achievement: {{ $player->achievement_score }}</span>
							</div>
						</figcaption>
					</figure>
				</div>
			</div>

@else

	@if($a==4) <!-- 4 -->
	        <div class="col-md-12">
	            <div class="panel-body">
	            	<div class="panel-text">
	            		<div class="table-responsive">
	                		<table class="table table-hover league-table">
	                			<thead>
	                				<th>#</th>
	                				<th>Name</th>
	                				<th>Score <span></span></th>
	                				<!-- <th>Outtings</th> -->
	                			</thead>
    @endif

	                			<tr class="league-row-{{ $a }}">
		                    		<td style="font-weight:bold;">{{ $a }}</td>
		                    		<td><img src="{{ $player->image }}" />{{ $player->firstName }} {{ $player->lastName }}</td>
		                    		<td>{{ $player->total_score }} <span> - {{ $player->match_score }} Match / {{ $player->achievement_score }} Achievement</span></td>
		                    		<!-- <td> Number of Matches</td> -->
	                	        </tr>

@endif

    <?php $a++; ?>
@endforeach



@if($a>4) <!-- 4 -->
		    				</table>
		    			</div>
		    		</div>
				</div>
			</div>
@endif
		</div>
	</div>
</div>

@if($league->disable_last_outting == false)
<div class="container">
	
</div>
@endif

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div id="Matches" class="panel panel-default panel-borderless">
				<div class="panel-heading">
					<h2 class="panel-title"><span>The Matches</span></h2>
				</div>
				<div class="panel-body">
					<div class="panel-text">
						{{ $league->matches_blurb }}
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default panel-borderless">
        		<div class="table-responsive">
            		<table class="table table-hover league-table">
            			<thead>
            				<th>Date</th>
            				<th>Course</th>
            				<th>Holes Played</th>
            				<th>Winner</th>
            			</thead>
						@foreach($matches as $match)
						<tr>
							<td>{{ date('M d, Y', strtotime($match->date)) }}</td>
							<td>{{ $match->course->name }}</td>
							<td>{{ $match->holesPlayed }}</td>
							<td>
								@if ($match->winner)
									{{ $match->winner->firstName }} {{ $match->winner->lastName }}
								@endif
							</td>
						</tr>
						@endforeach
					</table>
				</div>
			</div>
		</div>

		<div class="col-md-12">
	</div>
</div>

@if($league->is_achievements == true)
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div id="Achievements" class="panel panel-default panel-borderless">
					<div class="panel-heading">
						<h2 class="panel-title"><span>The Achievements</span></h2>
					</div>

					<div class="panel-body">
						<div class="panel-text">
							{{ $league->achievements_blurb }}
						</div>
					</div>
				</div>
			</div>
		</div>
			<?php $a = 1; ?>
			@foreach($league->achievements as $achievement)
				@if($achievement->value > 0)
					@if($a%2 != 0)
					<div class="row">
					@endif
					<div class="col-md-6 achievement-col-{{ $a%2 }}">
						<div class="panel panel-default panel-borderless">
							<div class="achievement-holder">
								<img src="{{ $achievement->icon }}" alt="achievement icon" />
								<div class="achievement-description">
									<h4>{{ $achievement->name }}</h4>
									<span>{{ $achievement->description }}</span>
								</div>
							</div>
						</div>
					</div>
					@if($a%2 == 0)
					</div>
					@endif
					<?php $a++; ?>
				@endif
			@endforeach
		</div>
	</div>
@endif

@if($league->disable_courses == false)
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div id="Courses" class="panel panel-default panel-borderless">
					<div class="panel-heading">
						<h2 class="panel-title"><span>The Courses</span></h2>
					</div>

					<div class="panel-body">
						<div class="panel-text">
							{{ $league->courses_blurb }}
						</div>
					</div>
				</div>
			</div>
		</div>
			<?php $a = 1; ?>
			@foreach($courses as $course)
				@if($a%2 != 0)
				<div class="row">
				@endif
				<div class="col-md-6 achievement-col-{{ $a%2 }}">
					<div class="panel panel-default panel-borderless">
						<div class="achievement-holder">
							<img src="{{ $course->image }}" alt="achievement icon" />
							<div class="achievement-description">
								<h4>{{ $course->name }}</h4>
								<span>{{ $course->city }}, {{ $course->state }}</span>
							</div>
						</div>
					</div>
				</div>
				@if($a%2 == 0)
				</div>
				@endif
				<?php $a++; ?>
			@endforeach
		</div>
	</div>
@endif

@if($league->disable_rules == false)
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div id="Rules" class="panel panel-default panel-borderless">
					<div class="panel-heading">
						<h2 class="panel-title"><span>The Rules</span></h2>
					</div>

					<div class="panel-body">
						<div class="panel-text">
							{{ $league->rules_blurb }}
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default panel-borderless">
					<div class="panel-body rule-body">
						<?php $a = 1; ?>
						@foreach($league->rules as $rule)
						<div class="rule-text">
							<h4>{{ $a }}-1 &nbsp; {{ $rule->title }}</h4>
							<p>{{ $rule->rule }}</p>
						</div>
						<?php $a++; ?>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
@endif
@endsection