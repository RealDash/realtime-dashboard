@extends('layouts.dashboard.master')

@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="x_panel">
        <div class="x_title">
            <h2>
                <i class="fa fa-bars"></i> My Tasks
                <small></small>
            </h2>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            @foreach(Auth::user()->tasks()->get() as $key => $task)
            <div class="col-md-4 col-xs-12 col-sm-6">
                <a href="{{url('tasks/show')}}/{{$task->id}}" class="col-md-12 col-xs-12 col-sm-12 well profile_view" style="background-color: white">
                    
                    <div class="text-center">
                        <span style="font-size: 18px">{{$task->title}}</span>
                        <br>
                    </div>
                    <div class="left">
                        <p><strong>Status : </strong> {{config('data')[$task->status]}} </p>
                        <p><strong>Task Category : </strong> {{$task->category->name}} </p>
                        <p><strong>Start Date : </strong> {{$task->start_at}} </p>
                        <p><strong>End Date : </strong> {{$task->end_at}} </p>
                    </div>
                    
                </a>
            </div>
            @endforeach
        </div>

        <div class="x_content">
          
          <table id="datatable" style="font-size: 13px;" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>S/N</th>
                <th>Task Title</th>
                <th>Task Description</th>
                <th>View</th>
                <th>Pick Task</th>
                
              </tr>
            </thead>

            <tbody>
              @foreach($tasks as $key => $task)
              <tr>
                <td>{{$loop->index + 1}}</td>
                <td>{{$task->title}}</td>
                <td>{{substr($task->description, 0, 70)}}</td>
                <td>
                    <a href="{{url('tasks/show')}}/{{$task->id}}" class="btn btn-xs btn-primary">View</a>
                </td>
                <td>
                    @if(Auth::user()->tasks()->where('task_id', $task->id)->exists())
                        <span style="padding: 1px;">
                            <label class="label btn-success">Picked Already</label>
                        </span>

                    @else
                        <form method="post" action="{{route('pick-task')}}">
                            @csrf
                            <input type="hidden" name="task_id" value="{{$task->id}}">
                            <button class="btn btn-success btn-xs"> Pick Task</button>
                        </form>
                    @endif
                </td>
              </tr>
              @endforeach
        </div>

    </div>
</div>
@endsection

<style>
    .profile_view{
        margin: 5px;
    }
</style>

