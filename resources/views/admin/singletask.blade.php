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
              <div class="col-md-4 col-xs-12 col-sm-6 col-md-push-8 col-sm-push-6">
                <form class="form-horizontal form-label-left" novalidate>     

                  <div class="item form-group">

                      <select id="name" class="form-control">
                        @foreach(config('data') as $key => $status)
                          <option value="{{$key}}">{{$status}}</option>
                        @endforeach
                      </select>
                      
                  </div>

                  <div class="form-group pull-right">                
                      <button id="send" type="submit" class="btn btn-sm btn-success">Submit</button>
                  </div>
                </form>
            </div>
        </div>
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
                          <th style="width: 20%">#Edit</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                            
                          <td>
                            <ul class="list-inline">
                              <li>
                                <img src="{{asset('images/user.png')}}" class="avatar" alt="Avatar">
                              </li>
                              <li>
                                <img src="{{asset('images/user.png')}}" class="avatar" alt="Avatar">
                              </li>
                              <li>
                                <img src="{{asset('images/user.png')}}" class="avatar" alt="Avatar">
                              </li>
                              <li>
                                <img src="{{asset('images/user.png')}}" class="avatar" alt="Avatar">
                              </li>
                            </ul>
                          </td>
                          <td class="project_progress">
                            <div class="progress progress_sm">
                              <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="57"></div>
                            </div>
                            <small>57% Complete</small>
                          </td>
                          <td style="padding-top: 12px">
                            <label class="label btn-success">Success</label>
                          </td>
                          <td>
                            <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
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