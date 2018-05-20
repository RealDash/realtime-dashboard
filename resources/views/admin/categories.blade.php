@extends('layouts.dashboard.master') 
@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="row">
  <div style="margin-left: 10px;">
    <a href="#demo" class="btn btn-success" data-toggle="collapse">Create Category</a>
  </div>
  <div id="demo" class="collapse">  
    <br>
    <form class="form-horizontal form-label-left" action="{{route('admin.category.create')}}" method="post" novalidate>
        <div class="col-md-4 col-xs-12 col-sm-6">           
              @csrf
              <div class="item form-group">
                  <input id="name" class="form-control" name="name"
                      placeholder="E.g Marketing" required="required" type="text">
                      @if ($errors->has('name'))
                            <span class="help-block">
                                {{ $errors->first('name') }}
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
          <h2>Manage Categories
            <!-- <small>Users</small> -->
          </h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          
          <table id="datatable" style="font-size: 13px;" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>S/N</th>
                <th>Category Name</th>
                <th>Edit</th>
                
              </tr>
            </thead>

            <tbody>
              @foreach($categories as $key => $category)
              <tr>
                <td>{{$loop->index + 1}}</td>
                <td>{{$category->name}}</td>
                <td>
                    <a href="{{url('admin/manage/category')}}/{{$category->id}}" class="btn btn-xs btn-primary">Edit</a>
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