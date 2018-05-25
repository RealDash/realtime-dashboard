@extends('layouts.dashboard.master')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="row">
  <div style="margin-left: 10px;">
    <a href="#demo" class="btn btn-success" data-toggle="collapse">New Announcement</a>
  </div>
  <div id="demo" class="collapse">
    <br>
    <form class="form-horizontal form-label-left" action="{{route('new.announcement')}}" method="post" novalidate>
        <div class="col-md-4 col-xs-12 col-sm-6">
              @csrf
              <div class="item form-group">
                  <input id="name" class="form-control" name="subject"
                      placeholder="Subject" required="required" type="text">
                      @if ($errors->has('subject'))
                          <span class="help-block">
                              {{ $errors->first('subject') }}
                          </span>
                      @endif
              </div>
              <div class="item form-group">
                  <textarea id="textarea" rows="6" required="required" name="message_body" placeholder="Message" class="form-control col-md-7 col-xs-12"></textarea>
                  @if ($errors->has('message_body'))
                      <span class="help-block">
                          {{ $errors->first('message_body') }}
                      </span>
                  @endif
              </div>

              <div class="form-group">
                  <button id="send" type="submit" class="btn btn-success">Submit</button>
              </div>

          </form>
      </div>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">

        <div class="x_title">
          <h2>Announcements
            <!-- <small>Users</small> -->
          </h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <table id="datatable" style="font-size: 13px;" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>S/N</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Announcer</th>
                <th>Action</th>

              </tr>
            </thead>

            <tbody>
              @foreach($announcements as $key => $announcement)
              <tr>
                <td>{{$loop->index + 1}}</td>
                <td>{{$announcement->subject}}</td>
                <td>{!! str_limit($announcement->message, 65, ' ...') !!}</td>
                <td>{{ $announcement->user->user_name}}</td>
                <td>
                    <a href="{{url('admin/manage/announcement')}}/{{$announcement->id}}" class="btn btn-xs btn-primary">View</a>
                    <a href="{{url('admin/manage/announcement')}}/{{$announcement->id}}" class="btn btn-xs btn-danger">Delete</a>
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
  .calender{
    font-size: 13px;
  }
</style>
