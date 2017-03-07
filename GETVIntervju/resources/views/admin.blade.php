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

        <div class="content">
            <div class="title m-b-md">
                <a class="title" href=" {{ url('') }}">GE-TV Administratorside</a>
            </div>

            <div class="links">
                <a href="/">GE-TV</a>
                <a href="/admin/add">Ny video</a>
                <a href="/admin/changepassword">Endre passord</a>
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
    <div class="links">
      @if(!Auth::check())
      <a href="/login">Administrator</a>
      @else
      <a href="/admin">Administrator</a>
      <a href="/logout">Logg ut</a>
      @endif
  </div>
</footer>
</html>
