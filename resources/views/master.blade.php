<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>Test</title>
</head>
<body class="d-flex flex-column">
    <div id="header" class="position-fixed w-100">
        <div class="container py-4 d-flex align-items-center">
            @auth
                <a href="{{ url('/logout') }}" class="mr-auto" style="padding: 7px 0;"><strong>Logout</strong></a>
                {{--<a href="{{ url('/show/name', ['type' => 'movie']) }}" class="">Movies by Name</a>
                <a href="{{ url('/show/name', ['type' => 'show']) }}" class="">Shows by Name</a>
                <a href="{{ url('/show/date', ['type' => 'movie']) }}" class="">Release Calendar</a>--}}
                <div class="d-flex flex-grow-1" style="max-width: 75%;">
                    <form class="flex-grow-1" action="{{ url('show/local') }}" method="post">
                        <div class="d-flex">
                            <div class="form-group d-flex flex-grow-1 mb-0 mr-3 position-relative">
                                <select id="type" name="type">
                                    <option value="movie" selected="selected">Movie</option>
                                    <option value="show">Show</option>
                                    <option value="episode">Episode</option>
                                </select>
                                <div class="col px-0">
                                    <input id="title" placeholder="Search locally" class="w-100 h-100" type="text" name="title">
                                </div>
                                <div id="search-movie" class="d-none border-0" data-url="{{ url('show/single') }}"></div>
                            </div>
                            <div class="d-flex pr-0 justify-content-end">
                                <button class="btn search-btn" type="button" data-url="{{ url('show/online') }}">Search online</button>
                            </div>
                        </div>
                    </form>

                </div>
            @else
                <a href="{{ url('/') }}" class="" style="padding: 7px 0;"><strong>Login</strong></a>
            @endauth
        </div>
    </div>

    <div id="main" class="d-flex flex-column flex-grow-1">
        @yield('content')
    </div>

    <div id="footer">
        <script src="{{ asset('js/jquery-1.12.4.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    </div>
</body>
</html>
