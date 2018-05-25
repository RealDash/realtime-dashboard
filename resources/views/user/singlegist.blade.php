@extends('layouts.dashboard.master')

@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="x_panel">
    <div>
      <h2>
        <i class="fa fa-comment"></i> {{$gist->title}} By {{$gist->user->last_name}} {{$gist->user->first_name}} ({{$gist->user->user_name}})
        <small></small>
      </h2>
      <br>

      <div class="clearfix"></div>
    </div>
    <div class="x_content">  
      <div class="col-md-12 col-sm-9 col-xs-12">
        <div class="col-md-6" style="text-align:left;">
          <table width="100%">
            <tr width="40%">
            <td style="padding-right:30px;"><h4>Title:</h4></td> 
              <td><h4>{{$gist->title}}</h4></td>
            </tr>
            <tr>
              <td><h4>Gist:</h4></td> 
              <td><h4>{{$gist->gist}}</h4></td>
            </tr>
            <tr>
              <td><h4>Date Posted:</h4></td> 
              <td><h4>{{date_format($gist->created_at, 'M j, Y')}} at {{date_format($gist->created_at, 'H:i a')}}</h4></td>
            </tr>       

          </table>
        </div>  
      </div>
    </div>
  </div>
</div>
@endsection

<style>
  .profile_view{
    margin: 5px;
  }
</style>