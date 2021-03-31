<div class="d-flex flex-column">
    @if(isset($noShow))
        <div class="p-3 text-warning">No data was found locally. Would you like to search online?</div>
        @if(isset($failResponse))
            <div class="p-3 text-danger">{{ $failResponse }}</div>
        @endif
        <div class="p-3">
            <button class="btn btn-light" data-url="" type="button">No</button>
            <button class="btn btn-success" data-url="{{ url('show/online') }}" type="button">Yes</button>
        </div>
    @else
        @foreach($shows as $show)
            <div class="movie d-flex align-items-center p-3">
                <input class="showID" type="hidden" name="showID" value="{{ $show['showID'] }}">
                @if(!empty($show['poster']))
                    <div class="poster-container col-auto"><img src="{{ asset('posters').'/'.$show['poster'] }}"></div>
                @endif
                <div class="ml-3">{{ $show['title'] }} ({{ $show['year'] }})</div>
            </div>
        @endforeach
    @endif
</div>
