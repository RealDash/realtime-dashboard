
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
                    <div class="text-center cyan" style="padding-bottom: 30px; font-size: 24px">{{env('APP_NAME')}}</div>
                    <form action="{{route('login')}}" method="POST" role="form">
                        
                        @csrf
                        <div class="form-group">
                            
                            <input type="email" name="email" class="form-control" placeholder="Email">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    {{ $errors->first('email') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            
                            <input type="password" name="password" class="form-control" placeholder="Password">
                            @if ($errors->has('[password]'))
                                <span class="help-block">
                                    {{ $errors->first('[password]') }}
                                </span>
                            @endif
                        </div>
                    
                    
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    <div style="padding-top: 20px;">
                        <a class="cyan" href="{{route('register')}}">Register</a>
                    </div>

                    <div style="padding-top: 20px;">
                        <a class="cyan" href="{{route('password.request')}}">I forgot my password</a>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>
