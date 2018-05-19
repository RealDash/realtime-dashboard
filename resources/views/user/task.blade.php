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
            <div class="col-md-4 col-xs-12 col-sm-6">
                <a href="{{url('tasks/show')}}/3" class="col-md-12 col-xs-12 col-sm-12 well profile_view" style="background-color: white">
                    
                    <div class="text-center">
                        <span style="font-size: 18px">Build a real time poll app with Callback</span>
                        <br>
                    </div>
                    <div class="left">
                        <p><strong>Status : </strong> {{config('data')[3]}} </p>
                        <p><strong>Task Category : </strong> Weekly Task </p>
                        <p><strong>Start Date : </strong> 23-07-2018 </p>
                        <p><strong>End Date : </strong> 30-07-2018 </p>
                    </div>
                    
                </a>
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

   
