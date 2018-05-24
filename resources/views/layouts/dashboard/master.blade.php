<!DOCTYPE html>
<html lang="en">
@include('layouts.dashboard.head')

<body class="nav-md">
    <div class="container body">
      <div class="main_container">
        @include('layouts.dashboard.sidebar')
        @include('layouts.dashboard.nav')
        @yield('content')

        @include('layouts.dashboard.foot')
     </div>
    </div>
    
    @include('layouts.dashboard.footmeta')
      
    @if(Session::has('success'))   
        <script>
          success('Good', "{{Session::get('success')}}")
        </script>
    @endif

    @if(Session::has('error'))
      <script>
        error('Oops!', "{{Session::get('error')}}")
      </script>
    @endif
  </body>
</html>
