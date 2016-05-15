@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					League Index
				</div>

				<div class="panel-body">
					<table class="table table-hover">
						<tr>
							<th>League Name</th>
							<th>Owner</th>
							<th># Players</th>
							<th>Status</th>
						</tr>
						@foreach ($leagues as $league)
							<tr>
								<td>
									<a href="/league/{{ $league->id }}">{{ $league->name }}</a>
								</td>
								<td>
									{{ $league->owner->name }}
								</td>
								<td>
									{{ $league->players->count() }}
								</td>
								<td>
									@if ($league->active == true)
										Active
									@else
										Inactive
									@endif
								</td>
							</tr>
						@endforeach
					</table>

					{!! $leagues->links() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection