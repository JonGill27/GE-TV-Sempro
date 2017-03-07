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
                    <a class="title" href=" {{ url('') }}">Endre passord</a>
                </div>

                <div class="links">
                    <a href="/">GE-TV</a>
                    <a href="/admin">Administratorside</a>
                    <a href="/admin/add">Ny video</a>
                </div>
                
                <form action = "/admin/changepassword" method = "post">
                   <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">

                   <div class="form-group">
                    <label for="password">Passord</label>
                    <input type='text' name='password' class="form-control" placeholder="Skriv inn gjeldende passord">
                    @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
                </div>
                
                 <div class="form-group">
                    <label for="newpassword">Nytt passord</label>
                    <input type='text' name='newpassword' class="form-control" placeholder="Skriv inn nytt passord">
                    @if ($errors->has('newpassword')) <p class="help-block">{{ $errors->first('newpassword') }}</p> @endif
                </div>

                  <div class="form-group">
                    <label for="repeatnewpassword">Gjenta nytt passord</label>
                    <input type='text' name='repeatnewpassword' class="form-control" placeholder="Gjenta nytt passord">
                    @if ($errors->has('repeatnewpassword')) <p class="help-block">{{ $errors->first('repeatnewpassword') }}</p> @endif
                </div>

                <button type="submit" class="btn btn-primary">Endre passord</button>

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
