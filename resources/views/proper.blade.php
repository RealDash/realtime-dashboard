<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Real time dashboard</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css')}}/main.css?{{md5(date('h:i:s'))}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    
    <body class="background">
        <div id="app">
            <div class="row">

                <div class="c20">
                    @foreach($users as $key => $user)
                    <team pname="{{$user->first_name}} {{$user->last_name}}" pusername="{{$user->user_name}}" pid="{{$user->id}}"></team>
                    @endforeach
                    
                </div>

                <div class="c15">
                    <upcoming></upcoming>
                    <team pname="" pusername="" pid=""></team>
                    <team pname="" pusername="" pid=""></team>
                </div>

                <div class="c35">
                    <div class="c100">
                        <music></music>
                    </div>

                    <announcement title="announce-it"></announcement>

                    <div class="row" style="margin: 0; margin-top: -5px;">
                        <div class="c50">
                            <team pname="" pusername="" pid=""></team>
                        </div>

                        <div class="c50">
                            <team pname="" pusername="" pid=""></team>
                        </div>
                    </div>
                    <div class="row" style="margin: 0; margin-top: -5px;">
                        <gossip></gossip>
                    </div>
                </div>

                <div class="c30">
                    <div class="row" style="margin: 0;">
                        <clock></clock>
                    </div>
                    <div class="row" style="margin: 0;">
                        <scrumy></scrumy>
                    </div>
                    <div class="row" style="margin: 0;">
                        <div class="c50">
                            <github></github>
                        </div>
                        <div class="c50">
                            <bitbucket></bitbucket>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <script src="{{asset('js/app.js')}}"></script>
    </body>

</html>