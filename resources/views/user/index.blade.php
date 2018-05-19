@extends('layouts.dashboard.master')

@section('content')
<!-- page content -->
<div class="right_col" role="main">
<div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-bars"></i> Dashboard
                        <small></small>
                    </h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="col-md-4 col-xs-12 col-sm-6">
                        <a href="{{url('tasks/pending')}}" class="col-md-12 col-xs-12 col-sm-12 well profile_view" style="background-color: white">
                            
                            <div class="text-center">
                                <i class="fa fa-warning fa-3x" style="color: #f0ad4e;"></i>
                                <br><br>
                            </div>
                            <div class="text-center" style="font-size: 23px; margin-bottom: 5px;">
                                Pending
                            </div>
                            <div class="left">
                                <p><strong>Team Numbers : </strong> 5 </p>
                                <p><strong>Task Category : </strong> Weekly Task </p>
                                <p><strong>Task Title : </strong> Build a Login Module </p>
                                <p><strong>Start Date : </strong> 23-07-2018 </p>
                                <p><strong>End Date : </strong> 30-07-2018 </p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4 col-xs-12 col-sm-6">
                        <a href="{{url('tasks/inprogress')}}" class="col-md-12 col-xs-12 col-sm-12 well profile_view" style="background-color: white">
                            
                            <div class="text-center">
                                <i class="fa fa-circle-o-notch fa-3x"></i>
                                <br><br>
                            </div>
                            <div class="text-center" style="font-size: 23px; margin-bottom: 5px;">
                                In Progress
                            </div>
                            <div class="left">
                                <p><strong>Team Numbers : </strong> 5 </p>
                                <p><strong>Task Category : </strong> Weekly Task </p>
                                <p><strong>Task Title : </strong> Build a Login Module </p>
                                <p><strong>Start Date : </strong> 23-07-2018 </p>
                                <p><strong>End Date : </strong> 30-07-2018 </p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4 col-xs-12 col-sm-6">
                        <a href="{{url('tasks/completed')}}" class="col-md-12 col-xs-12 col-sm-12 well profile_view" style="background-color: white">
                            
                            <div class="text-center">
                                <i class="fa fa-check green fa-3x"></i>
                                <br><br>
                            </div>
                            <div class="text-center" style="font-size: 23px; margin-bottom: 5px;">
                                Completed
                            </div>
                            <div class="left">
                                <p><strong>Team Numbers : </strong> 5 </p>
                                <p><strong>Task Category : </strong> Weekly Task </p>
                                <p><strong>Task Title : </strong> Build a Login Module </p>
                                <p><strong>Start Date : </strong> 23-07-2018 </p>
                                <p><strong>End Date : </strong> 30-07-2018 </p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4 col-xs-12 col-sm-6">
                        <a href="{{url('tasks/verified')}}" class="col-md-12 col-xs-12 col-sm-12 well profile_view" style="background-color: white">
                            
                            <div class="text-center">
                                <i class="fa fa-check green fa-3x"></i>
                                <br><br>
                            </div>
                            <div class="text-center" style="font-size: 23px; margin-bottom: 5px;">
                                Verified
                            </div>
                            <div class="left">
                                <p><strong>Team Numbers : </strong> 5 </p>
                                <p><strong>Task Category : </strong> Weekly Task </p>
                                <p><strong>Task Title : </strong> Build a Login Module </p>
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

   
