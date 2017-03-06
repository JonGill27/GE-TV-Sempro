<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GE-TV</title>

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css') }}">
</head>
<body>
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
        <div class="top-right links">
            @if (Auth::check())
            <a href="{{ url('/home') }}">Home</a>
            @else
            <a href="{{ url('/login') }}">Login</a>
            <a href="{{ url('/register') }}">Register</a>
            @endif
        </div>
        @endif

        <div class="content">
            <div class="title m-b-md">
                <a class="title" href=" {{ url('') }}">GE-TV</a>
            </div>

            <div class="links">
                <a href="{{ url('') }}">Alle</a>
                @foreach ($categories as $category)
                <a href="/category/{{ $category }}">{{ $category }}</a>
                @endforeach
                </br>
                <a href="{{ url('') }}">Arkiv</a>
                @foreach ($years as $year)
                <a href="/arkiv/{{ $year }}">{{ $year }}</a>
                @endforeach
            </div>

            <div class="message">
             {{ $message or '' }}
         </div>

         @if (isset($highlighted))
            <div class="highlighted">
                <iframe width="900px" height="300px"
                    src="{{ $highlighted->url }}">
                </iframe>
            </div>
        @endif

    <div class="container">
        @foreach ($videos as $video)
        <iframe width="300px"
        src="{{ $video->url }}">
    </iframe>
    @endforeach
</div>
<div class="pagination">

    {{ $videos->links() }}

</div>
</div>
</div>
</body>
<footer>  
    <a href="/admin">Administrator</a>
</footer>
</html>
