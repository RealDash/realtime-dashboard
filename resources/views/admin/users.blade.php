@extends('layouts.dashboard.master') 
@section('content')
<!-- page content -->
<div class="right_col" role="main">
<div class="row">
  <div style="margin-left: 10px;">
    <a href="#demo" class="btn btn-success" data-toggle="collapse">Create User</a>
  </div>
  <div id="demo" class="collapse">  
    <br>
    <form class="form-horizontal form-label-left" action="{{route('register')}}" method="post" novalidate>
        <div class="col-md-4 col-xs-12 col-sm-6">           
              @csrf
              <div class="item form-group">
                  <input class="form-control" name="firstname"
                      placeholder="Enter Firstname" required="required" type="text">
                      @if ($errors->has('firstname'))
                          <span class="help-block">
                              {{ $errors->first('firstname') }}
                          </span>
                      @endif
              </div>

              <div class="item form-group">
                  <input class="form-control" name="lastname"
                      placeholder="Enter Lastname" required="required" type="text">
                      @if ($errors->has('lastname'))
                          <span class="help-block">
                              {{ $errors->first('lastname') }}
                          </span>
                      @endif
              </div>

              <div class="item form-group">
                  <input class="form-control" name="username"
                      placeholder="Enter Username" required="required" type="text">
                      @if ($errors->has('username'))
                          <span class="help-block">
                              {{ $errors->first('username') }}
                          </span>
                      @endif
              </div>

              <div class="item form-group">
                  <input type="email" class="form-control" name="email"
                      placeholder="Enter Email" required="required">
                      @if ($errors->has('email'))
                          <span class="help-block">
                              {{ $errors->first('email') }}
                          </span>
                      @endif
              </div>

              <div class="item form-group">
                  <input class="form-control" name="password"
                      placeholder="Password" required="required" type="password">
                      @if ($errors->has('password'))
                            <span class="help-block">
                                {{ $errors->first('password') }}
                            </span>
                        @endif
              </div>

              <div class="item form-group">
                  <input class="form-control" name="password_confirmation"
                      placeholder="Confirm Password" required="required" type="password">
              </div>
         
              <div class="form-group">
                  <button id="send" type="submit" class="btn btn-success">Submit</button>
              </div>

          </form>
      </div>
    </div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Manage Users
            <!-- <small>Users</small> -->
          </h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          
          <table id="datatable" style="font-size: 13px;" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>S/N</th>
                <th>Username</th>
                <th>Email</th>
                <th>Ban/Unban</th>
                <th>Delete</th>
                <th>View</th>
              </tr>
            </thead>

            <tbody>
              @foreach($users as $key => $user)
              <tr>
                <td>{{$loop->index + 1}}</td>
                <td>{{$user->user_name}}</td>
                <td>{{$user->email}}</td>
                <td>
                  <button class="btn btn-xs btn-success">Unban</button>
                </td>
                <td>
                <button class="btn btn-xs btn-danger">Delete</button>
                </td>
                <td>
                <a href="" class="btn btn-xs btn-primary">View</a>
                </td>
              </tr>
              @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

<style>
  .profile_view {
    margin: 5px;
  }
</style>