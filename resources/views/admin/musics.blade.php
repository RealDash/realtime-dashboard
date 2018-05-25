@extends('layouts.dashboard.master') @section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="row">
    <div style="margin-left: 10px;">
      <a href="#demo" class="btn btn-success" data-toggle="collapse">Create Music</a>
    </div>
    <div id="demo" class="collapse">
      <br>
      <div class="col-md-4 col-sm-6">
      <form action="{{route('music.create')}}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="item form-group">

          <input class="form-control" name="music_title" placeholder="Enter Music title e.g Sarz on the beats" type="text"> @if ($errors->has('music_title'))
          <span class="help-block">
            {{ $errors->first('music_title') }}
          </span>
          @endif
        </div>


        <div class="form-group">

          <label for="program_description" class="control-label">Artist</label>
          <select class="form-control" name="artist_id">
            <option selected="true" value="select">Select Artist</option>
            @foreach($artists as $key => $artist)
            <option value="{{$artist->id}}">
              {{$artist->artist_name}}
            </option>
            @endforeach
          </select>
          @if ($errors->has('artist_id'))
          <span class="help-block">
            {{ $errors->first('artist_id') }}
          </span>
          @endif
        </div>

        <div class="form-group">

          <label for="file" class="control-label">Music File
            <i class="fa fa-music"></i>
          </label>

          <input name="file_name" type="file"> 
          @if ($errors->has('file_name'))
          <span class="help-block">
            {{ $errors->first('file_name') }}
          </span>
          @endif
        </div>

        <div class="form-group" style="padding-top: 20px;">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>

      </form>
</div>
    </div>
  </div>

  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">

      <div class="x_title">
        <h2>Manage Musics
          <!-- <small>Users</small> -->
        </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">

        <table id="datatable" style="font-size: 13px;" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>S/N</th>
              <th>Music Title</th>
              <th>Artist Name</th>
              <th>Play Current Music</th>
              <th>Delete</th>

            </tr>
          </thead>

          <tbody>
            @foreach($musics as $key => $music)
            <tr>
              <td>{{$loop->index + 1}}</td>
              <td>{{$music->music_title}}</td>
              <td>{{$music->artist->artist_name}}</td>
              <td><button onclick="setAsCurrent({{$loop->index}})" class="btn btn-xs btn-success">Play Current Music</button></td>
              <td>
                  <form method="post" onsubmit="submitForm('Are you sure you want to delete this music?');" action="{{url('admin/manage/music/delete')}}/{{$music->id}}">
                    <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                    
                    @csrf
                  </form>
              </td>
            </tr>
            @endforeach
      </div>
    </div>
  </div>
</div>
</div>
@endsection
<script>
  function submitForm(message) {
   var yes = confirm(message);
  
    return yes;
}

function setAsCurrent(index){
  axios.get('/api/v1/music/setcurrent/'+index)
      .then(response =>{
        success('Good', response.data.message);
      })
      .catch(error =>{

      });
}
</script>
<style>
  .calender {
    font-size: 13px;
  }
</style>