@extends('layouts.dashboard.master')

@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="x_panel">
        <div>
            <h2>
                <i class="fa fa-bars"></i> {{$task->title}}
                <small></small>
            </h2>
            <br>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="col-md-12 col-xs-12 col-sm-12">
            
            <p style="font-size: 15px;" class="text-justify">
              {{$task->description}}
            </p>
            <br><br>

            <!-- start project list -->
            <table class="table table-striped projects">
                      <thead>
                        <tr>
                          
                          <th>Team Members</th>
                          <th>Project Progress</th>
                          <th>Status</th>
                          <th style="width: 20%">Change Task Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                            
                          <td>
                            <ul class="list-inline">
                              @foreach($task->users()->get() as $key => $user)
                              <li>
                                <img title="{{$user->first_name}} {{$user->last_name}}" src="{{asset('images/user.png')}}" class="avatar" alt="Avatar">
                              </li>
                              @endforeach
                              
                            </ul>
                          </td>
                          <td class="project_progress">
                            <div class="progress progress_sm">
                              <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="57"></div>
                            </div>
                            <small>57% Complete</small>
                          </td>
                          <td style="padding-top: 12px">
                            <label class="label label-default">{{config('data')[$task->status]}}</label>
                          </td>
                          <td>
                            @if($task->status == config('data')['Completed'])
                              <label class="label label-success"></label>
                            @else
                              <form action="{{route('task.markas.completed')}}" method="post">
                                @csrf
                                <input type="hidden" name="task_id" value="{{$task->id}}">
                                <button type="submit" class="btn btn-primary btn-xs">mark as completed</i></button>
                              </form>
                            @endif
                          </td>
                        </tr>
                    </tbody>
                </table>

                    
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
