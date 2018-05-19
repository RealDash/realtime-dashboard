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
  </body>
</html>
