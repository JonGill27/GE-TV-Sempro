<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GE-TV Administrator</title>

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
                <a class="title" href=" {{ url('') }}">GE-TV Administratorside</a>
            </div>

            <div class="links">
                <a href="/admin">Administratorside</a>
                <a href="/admin/add">Ny video</a>
            </div>

            <div class="message">
             {{ $message or '' }}
         </div>

         <div class="container">
            <table class="table table-striped table-bordered table-hover">
               <tr>
                   <th>Navn</th>
                   <th>Beskrivelse</th> 
                   <th>Kategori</th>
                   <th></th>
                   <th></th>
               </tr>
               @foreach ($videos as $video)
               <tr>
                <td>{{ $video->name }}</td>
                <td>{{ $video->description }}</td>
                <td>{{ $video->category }}</td>
                <td><a href="/admin/edit/{{ $video->id }}" class="btn btn-info" role="button" aria-pressed="true">Endre</a></td>
                <td><a href="/admin/delete/{{ $video->id }}" class="btn btn-danger" role="button" aria-pressed="true">Slett</a></td>
            </tr>
            @endforeach
        </table>
    </div>   
</div>
</div>
</body>
<footer>
    <a href="/admin">Administrator</a>
</footer>
</html>
