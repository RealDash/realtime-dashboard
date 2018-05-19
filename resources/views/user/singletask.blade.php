@extends('layouts.dashboard.master')

@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="x_panel">
        <div>
            <h2>
                <i class="fa fa-bars"></i> Building the board
                <small></small>
            </h2>
            <br>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="col-md-12 col-xs-12 col-sm-12">
            
            <p style="font-size: 15px;" class="text-justify">
            Deserunt fugiat proident aute minim. Esse proident ipsum eu nostrud reprehenderit sunt eu. Exercitation adipisicing laboris Lorem dolor officia exercitation sit voluptate esse id Lorem. Nisi laborum sit labore minim non laborum ea do magna eu. Pariatur eiusmod laboris dolore proident voluptate voluptate magna cupidatat exercitation incididunt eiusmod. Id amet ex pariatur consequat sit veniam ullamco. Labore deserunt fugiat incididunt aliqua labore aute adipisicing est.

Reprehenderit aliqua ex ullamco nisi sint voluptate dolore ipsum nulla est Lorem sint. Sit id sint eiusmod officia. Nostrud labore aliquip duis qui labore occaecat consectetur officia occaecat sint. Ex eu sunt est qui ea Lorem consectetur laborum anim velit in et officia.

Dolor nostrud tempor exercitation Lorem commodo Lorem culpa laborum pariatur velit eu. In elit pariatur anim id amet sunt laborum amet dolor Lorem est enim Lorem. Amet pariatur aliqua ullamco proident excepteur cillum. Commodo esse in aliquip aliqua sunt amet velit. Id cillum ad ex in consectetur nulla esse ea ipsum eiusmod cupidatat culpa consequat. Incididunt tempor labore consequat consequat nisi magna nulla aute in consequat ullamco qui consectetur ipsum.

Velit sit veniam ut amet proident irure proident. Consequat magna pariatur consectetur dolor duis ea mollit tempor amet adipisicing sunt excepteur nisi. Nisi dolore velit nisi exercitation laborum do Lorem anim labore sunt do nostrud ea do. Nisi quis id culpa excepteur.

Voluptate exercitation sit minim proident sit aliquip aliquip. Aliquip eiusmod do adipisicing eiusmod. Sit reprehenderit cillum officia id sunt et consequat eiusmod anim nostrud est laborum do. Sint est veniam duis velit sit est incididunt ut ea minim ex mollit dolor. Voluptate et sunt aute eu laboris officia irure aliqua voluptate. Reprehenderit mollit mollit in occaecat consequat.
            </p>

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

