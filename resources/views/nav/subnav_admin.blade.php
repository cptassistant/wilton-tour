@if(Auth::id() == $league->ownerID)
<ul class="nav navbar-nav navbar-right">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            Admin <span class="caret"></span>
        </a>

        <ul class="dropdown-menu" role="menu">
            <li><a href="/league/{{ $league->id }}/match/create">Create Match</a></li>
        </ul>
    </li>
</ul>
@endif