@extends('layouts.dashboard.master') @section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="x_content">

    <div class="col-md-4 col-sm-3 col-xs-12 profile_left">
      <div class="profile_img">
        <div id="crop-avatar">
          <!-- Current avatar -->
          <img class="img-responsive avatar-view" src="{{Auth::user()->avatar == null ? 'images/picture.jpg' : Auth::user()->avatar }}" alt="Avatar" title="Change the avatar">
          <i id="avatar-icon" class="fa fa-camera camera" style="color: #ededed; font-size: 24px; margin-left: 10px; margin-top: -25px"></i>
          <input type="file" style="visibility: hidden" id="avatar">
        </div>
      </div>
      <h3>{{Auth::user()->first_name}} {{Auth::user()->last_name}}</h3>

      <ul class="list-unstyled user_data">
        <li>
          <i class="fa fa-map-marker user-profile-icon"></i> 
        </li>

        <li>
          <i class="fa fa-briefcase user-profile-icon"></i> Software Engineer
        </li>

        <li class="m-top-xs">
          <i class="fa fa-external-link user-profile-icon"></i>
          <a href="http://www.kimlabs.com/profile/" target="_blank">www.kimlabs.com</a>
        </li>
      </ul>

      <a class="btn btn-sm btn-success">
        <i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
      <br />

    </div>

    <div class="col-md-4 col-sm-9 col-xs-12">
      <form action="{{route('changepassword')}}" method="post" class="form-horizontal">
        <h4 class="text-center">Change Password</h4>
        @csrf
        <div class="form-group form-group {{ $errors->has('oldpassword') ? ' has-error' : '' }}">
            
            <input type="password" name="oldpassword" id="" class="form-control" placeholder="old password" required="required">
            @if ($errors->has('oldpassword'))
                <span class="help-block">
                    {{ $errors->first('oldpassword') }}
                </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('newpassword') ? ' has-error' : '' }}">
            
            <input type="password" name="newpassword" class="form-control" placeholder="new password" required="required">
            @if ($errors->has('newpassword'))
                <span class="help-block">
                    {{ $errors->first('newpassword') }}
                </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('confirmpassword') ? ' has-error' : '' }}">
            
            <input type="password" name="confirmpassword" class="form-control" placeholder="confirm password" required="required">
            @if ($errors->has('confirmpassword'))
                <span class="help-block">
                    {{ $errors->first('confirmpassword') }}
                </span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-sm btn-info">Change Password</button>
        </div>
      </form>
    </div>

  </div>
  @endsection

  <style>
    .profile_view {
      margin: 5px;
    }
    .camera:hover{
      cursor: pointer;
    }
  </style>
  <script>

  </script>