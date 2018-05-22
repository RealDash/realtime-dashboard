@extends('layouts.dashboard.master') 
@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="row">
  <div style="margin-left: 10px;">
    <a href="#demo" class="btn btn-success" data-toggle="collapse">Create Artist</a>
  </div>
  <div id="demo" class="collapse">  
    <br>
    <form enctype="multipart/form-data" class="form-horizontal form-label-left" action="{{route('admin.artist.create')}}" method="post" novalidate>
        <div class="col-md-4 col-xs-12 col-sm-6">           
              @csrf
              <div class="item form-group">
                  <input class="form-control" name="artist_name"
                      placeholder="E.g Phyno" required="required" type="text">
                      @if ($errors->has('artist_name'))
                          <span class="help-block">
                              {{ $errors->first('artist_name') }}
                          </span>
                      @endif
              </div>
              
              <div class="item form-group">
                  <input type="file" name="avatar" class="form-control col-md-7 col-xs-12">
                  @if ($errors->has('avatar'))
                      <span class="help-block">
                          {{ $errors->first('avatar') }}
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
          <h2>Manage Artists
            <!-- <small>Users</small> -->
          </h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          
          <table id="datatable" style="font-size: 13px;" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>S/N</th>
                <th>Artist name</th>
                <th>delete</th>
                
              </tr>
            </thead>

            <tbody>
              @foreach($artists as $key => $artist)
              <tr>
                <td>{{$loop->index + 1}}</td>
                <td>{{$artist->artist_name}}</td>
                <td>
                    <a href="{{url('admin/manage/artist')}}/{{$artist->id}}" class="btn btn-xs btn-danger">Delete</a>
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
