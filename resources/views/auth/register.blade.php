
<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Title Page</title>

        <!-- Bootstrap CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{asset('css/custom.css')}}?huiu" rel="stylesheet">

        
    </head>
    <body class="backcover">
        
        <div class="container">
            <div class="row auth">
                <div class="col-md-4 col-md-offset-4 card">
                    <form action="{{route('register')}}" method="POST" role="form">
                        
                        @csrf

                        <div class="form-group">
                            
                            <input type="text" name="firstname" value="{{old('firstname')}}" class="form-control" placeholder="Enter Firstname">
                            @if ($errors->has('firstname'))
                                <span class="help-block">
                                    {{ $errors->first('firstname') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            
                            <input type="text" name="lastname" value="{{old('lastname')}}" class="form-control" placeholder="Enter Lastname">
                            @if ($errors->has('lastname'))
                                <span class="help-block">
                                    {{ $errors->first('lastname') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            
                            <input type="text" name="username" value="{{old('username')}}" class="form-control" placeholder="Enter Username">
                            @if ($errors->has('username'))
                                <span class="help-block">
                                    {{ $errors->first('username') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            
                            <input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="Email">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    {{ $errors->first('email') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            
                            <input type="password" name="password" class="form-control" placeholder="Password">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    {{ $errors->first('password') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                            
                        </div>
                    
                    
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
        </div>
    
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>
