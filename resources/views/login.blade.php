@extends('master')

@section('content')
    <div class="d-flex align-items-center justify-content-center flex-grow-1">
        <div class="p-3 bg-white border" style="border-radius: 5px;">
            <form action="{{ url('login') }}" method="post">
                @if(isset($text))
                    <div class="m-3" style="color: red;">
                        {{ $text }}
                    </div>
                @endif
                <div class="d-flex flex-column">
                    <div class="d-flex mb-3">
                        <label class="col-4 pl-0 mb-0" for="username">Username:</label>
                        <input id="username" class="col-8 pr-0" type="text" name="username">
                    </div>
                    <div class="d-flex mb-3">
                        <label class="col-4 pl-0 mb-0" for="password">Password:</label>
                        <input id="password" class="col-8 pr-0" type="password" name="password">
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="d-flex col-6 pl-0">
                        <label class="mb-0" for="remember">Remember me:</label>
                        <input id="remember" class="ml-auto" type="checkbox" name="remember">
                    </div>
                    <div class="d-flex col-6 pr-0 justify-content-end">
                        <button class="btn btn-success" type="submit">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
