@extends('layouts.dashboard.master') 
@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="row">
  <div style="margin-left: 10px;">
    <a href="#demo" class="btn btn-success" data-toggle="collapse">Create Task</a>
  </div>
  <div id="demo" class="collapse">  
    <br>
    <form class="form-horizontal form-label-left" action="{{route('new-task')}}" method="post" novalidate>
        <div class="col-md-4 col-xs-12 col-sm-6">           
              @csrf
              <div class="item form-group">
                  <input id="name" class="form-control" name="title"
                      placeholder="E.g Build a button" required="required" type="text">
              </div>

              <div class="item form-group">

                <select id="name" name="category" class="form-control">
                  @foreach($categories as $key => $category)
                  <option value="{{$category->id}}">{{$category->name}}</option>
                  @endforeach
                </select>

              </div>

              <div class="item form-group">
                <fieldset>
                  <div class="control-group">
                    <div class="controls">
                      <div class="input-prepend input-group">
                        <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                        <input type="text" name="start_date" id="reservation" class="form-control col-md-7 col-xs-12" value="01/01/2016 - 01/25/2016" />
                      </div>
                    </div>
                  </div>
                </fieldset>
              </div>
              
              <div class="item form-group">
                  <textarea id="textarea" rows="6" required="required" name="description" class="form-control col-md-7 col-xs-12"></textarea>
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
          <h2>Manage Tasks
            <!-- <small>Users</small> -->
          </h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          
          <table id="datatable" style="font-size: 13px;" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>S/N</th>
                <th>Task Title</th>
                <th>Task Description</th>
                <th>View</th>
                
              </tr>
            </thead>

            <tbody>
              @foreach($tasks as $key => $task)
              <tr>
                <td>{{$loop->index + 1}}</td>
                <td>{{$task->title}}</td>
                <td>{{substr($task->description, 0, 70)}}</td>
                <td>
                    <a href="{{url('admin/manage/task')}}/{{$task->id}}" class="btn btn-xs btn-primary">View</a>
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