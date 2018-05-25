@extends('layouts.dashboard.master') 
@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="row">
  <div style="margin-left: 10px;">
    <a href="#demo" class="btn btn-success" data-toggle="collapse">Create Gist</a>
  </div>
  <div id="demo" class="collapse">  
    <br>
    <form class="form-horizontal form-label-left" action="{{route('new-gist')}}" method="post" novalidate>
        <div class="col-md-4 col-xs-12 col-sm-6">           
              @csrf

              <div class="item form-group">
                  <textarea id="textarea" rows="6" required="required" name="gist" class="form-control col-md-7 col-xs-12"></textarea>
                  @if ($errors->has('gist'))
                      <span class="help-block">
                          {{ $errors->first('gist') }}
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
          <h2>Manage Gists
            <!-- <small>Users</small> -->
          </h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          
          <table id="datatable" style="font-size: 13px;" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>S/N</th>
                <th>Title</th>
                <th>Gist</th>
                <th>Date/Time</th>
                <th>View</th>
                
              </tr>
            </thead>

            <tbody>
              @foreach($gists as $key => $gist)
              <tr>
                <td>{{$loop->index + 1}}</td>
                <td>{{$gist->title}}</td>
                <td>{{substr($gist->gist, 0, 70)}}</td>
                <td>{{date_format($gist->created_at, 'M j, Y')}} at {{date_format($gist->created_at, 'H:i a')}}
                </td>
                <td>
                    <a href="{{url('view/gist')}}/{{$gist->id}}" class="btn btn-xs btn-primary">View</a>
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
