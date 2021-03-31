<div class="d-flex">
    @if(!empty($show['poster']))
        <div class="poster-container col-3"><img src="{{ asset('posters').'/'.$show['poster'] }}"></div>
    @endif
    <div class="d-flex flex-column flex-grow-1 ml-3 col-9">
        <h2 class="mb-3"><strong>{{ $show['title'] }}</strong></h2>
        <div class="d-flex mb-3">
            <div><strong>Rated</strong>: {{ $show['rated'] }}</div>
            <div class="ml-3"><strong>Year</strong>: {{ $show['year'] }}</div>
            <div class="ml-3"><strong>Duration</strong>: {{ $show['length'] }} min</div>
        </div>
        <div class="mb-3 d-flex flex-column">
            <strong class="mb-2">Ratings</strong>
            <div class="d-flex">
                @foreach($show['ratings'] as $rating)
                    <div class="col mr-3 py-3 d-flex flex-column bg-dark text-white align-items-center">
                        <div>{{ $rating->Source }}</div>
                        <div>{{ $rating->Value }}</div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="mb-3 d-flex">
            <strong>Genre</strong>:
            @foreach($show['genres'] as $genre)
                <div class="ml-2">{{ $genre->genre }}</div>
            @endforeach
        </div>
        <div class="mb-3 d-flex">
            <strong>Languages</strong>:
            @foreach($show['languages'] as $lang)
                <div class="ml-2">{{ $lang->language }}</div>
            @endforeach
        </div>
        <div class="mb-3 d-flex">
            <strong>Countries</strong>:
            @foreach($show['countries'] as $country)
                <div class="ml-2">{{ $country->country }}</div>
            @endforeach
        </div>
        <div class="mb-3 d-flex flex-column">
            @foreach($show['crew'] as $crewType => $crew)
                <div class="mb-3 d-flex">
                    <strong>{{ ucfirst($crewType) }}</strong>
                    @foreach($crew as $name)
                        <div class="ml-2">{{ $name }}</div>
                    @endforeach
                </div>
            @endforeach
        </div>
        <div class="d-flex flex-column">
            <strong class="mb-2">Plot</strong>
            <div>{{ $show['plot'] }}</div>
        </div>
    </div>
</div>
