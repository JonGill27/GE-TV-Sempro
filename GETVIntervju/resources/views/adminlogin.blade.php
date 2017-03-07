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
            <a class="title" href=" {{ url('') }}">GE-TV Administratorinnlogging</a>
        </div>

        <div class="links">
         <a href="/">GE-TV</a>
     </div>

     <div class="formmessage">
        {{ $message or '' }}
    </div>

    <form action = "/login" method = "post">
     <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">

     <div class="form-group">
        <label for="email">Brukernavn</label>
        <input type='text' name='email' class="form-control" placeholder="Skriv inn ditt brukernavn/epost">
        @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
    </div>

    <div class="form-group">
        <label for="password">Passord</label>
        <input type='password' name='password' class="form-control" placeholder="Skriv inn passord">
        @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
    </div>

    <button type="submit" class="btn btn-primary">Logg inn</button>
</form>
</div>
</body>
<footer>
</footer>
</html>
