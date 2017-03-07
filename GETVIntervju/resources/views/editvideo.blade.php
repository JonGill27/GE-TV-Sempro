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
                    <a class="title" href=" {{ url('') }}">Endre video</a>
                </div>

                <div class="links">
                    <a href="/">GE-TV</a>
                    <a href="/admin">Administratorside</a>
                    <a href="/admin/add">Ny video</a>
                    <a href="/admin/changepassword">Endre passord</a>
                </div>

                <form action = "/admin/edit/{{ $video->id }}" method = "post">
                   <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">

                   <div class="form-group">
                    <label for="name">Navn</label>
                    <input type='text' value="{{ $video->name }}" name='name' class="form-control" placeholder="Skriv inn videoens navn">
                    @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                </div>
                <div class="form-group">
                    <label for="description">Beskrivelse</label>
                    <textarea class="form-control" name="description" rows="3" placeholder="Skriv inn en beskrivelse av videoen">
                        {{ $video->description }}
                    </textarea>
                </div>

                <div class="form-group">
                    <label for="url">URL</label>
                    <input type='text' name='url' class="form-control" value="{{ $video->url }}" placeholder="Skriv inn videoens url">
                    @if ($errors->has('url')) <p class="help-block">{{ $errors->first('url') }}</p> @endif
                </div>
                <div class="form-group">
                    <label for="category">Kategori</label>
                    <input type='text' name='category' value="{{ $video->category }}" class="form-control" placeholder="Skriv inn videoens kategori">
                    @if ($errors->has('category')) <p class="help-block">{{ $errors->first('category') }}</p> @endif
                </div>
                <div class="form-group">
                    <label for="year">År</label>
                    <input type='text' name='year' value="{{ $video->year }}" class="form-control" placeholder="Skriv inn videoens årstall">
                    @if ($errors->has('year')) <p class="help-block">{{ $errors->first('year') }}</p> @endif
                </div>

                <div class="form-check">
                    <label for="highlighted" class="form-check-label">Fremhevet</label>
                    <input name='highlighted' type="checkbox" {{ $highlighted }} class="form-check-input">
                </div>

                <button type="submit" class="btn btn-primary">Endre</button>

                <div class="formmessage">
                    {{ $message or '' }}
                </div>

            </form>

        </div>
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
