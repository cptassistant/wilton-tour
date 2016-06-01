    <ul class="nav navbar-nav navbar-left isStuck">
        <li class="slide-in">
            <a href="/league/{{ $league->id }}">
                <img src="{{ $league->logo }}" />
                <div class="sub-nav-league-container">
                    <span class="league-name">{{ $league->name }}</span>
                    <span class="league-dates">{{ date('M d, Y', strtotime($league->start_date)) }} - {{ date('M d, Y', strtotime($league->end_date)) }}</span>
                </div>
            </a>
        </li>
    </ul>