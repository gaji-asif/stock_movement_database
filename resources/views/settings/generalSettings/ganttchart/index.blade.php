@extends('master')
@section('mainContent')
<div class="" style="margin-top: -20px;">
   <div class="card-datatable" style="margin-top: 0px; padding: 0px;">
      <div id="tickets-list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
         <div class="row">
            <div class="col-md-12">

<!-- ##################### AUTO ASSIGN MODAL START  ###########################-->

                                <div class="modal fade" id="myModal" role="dialog">
                                  <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                      <div class="modal-header py-2 px-1">
                                        <button type="button" id="closeautoassignbox" class="close" data-dismiss="modal" style="">&times;</button>
                                      </div>
                                      <div class="modal-body" style="padding: 13px 0px;">
                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="droptdownarea">
                                              <div class="input-group">
                          <!-- SEARCH PORTION STARTS -->
                                                <?php 
                                                    $loggedindeveloper = Session::get('developer_id');
                                                    if ($loggedindeveloper !== "" ) {
                                                      $projectlist = DB::table('dtb_projects')
                                                        ->select('id','project_name','developer_id','ordering')
                                                        ->where('developer_id', $loggedindeveloper)
                                                        ->orderBy('ordering','DESC')
                                                        ->get();
                                                    }
                                                ?>
                                                <select class="custom-select flex-grow-1 mr-3 mb-2" name="project" id="project" style="width: 180px">
                                                  <option>Select Project</option>
                                                  <?php if (isset($projectlist)) {?>
                                                      @foreach($projectlist as $devsproject)
                                                        <option value="{{ $devsproject->id ?? '' }}">{{ $devsproject->project_name ?? '' }}</option>
                                                      @endforeach
                                                  <?php } ?>
                                                </select>


                                                <select class="custom-select flex-grow-1 mr-3 mb-2" name="app" id="app" style="width: 180px">
                                                  <!-- data will take place here from ajax response -->
                                                </select>


                                                <select class="custom-select flex-grow-1  mr-3 mb-2" name="assignee" id="assignee" style="width: 180px">
                                                  <!-- data will take place here from ajax response -->
                                                </select>


                                                <span class="" id="assignee mb-2">
                                                  <button type="button" name="filter" id="filter" class="btn btn-info">Filter</button>
                                                  <button type="button" name="reset" id="reset" class="btn btn-default" style="color: white;border-color: white">Reset</button>
                                                </span>
                          <!-- SEARCH PORTION ENDS -->


                                              </div>
                                            </div>
                                          </div>
                                        </div> 

                                                
                                        <div class="row" style="margin-top: 15px">
                                          <div class="col-12">
                                            <div class="issuestblarea py-3 px-3" style="min-height: 200px;">
                                                 <div class="table-responsive">
                                                  <table id="autoassignsrchrslt" class="table table-bordered display">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Issue Title</th>
                                                            <th>Category</th>
                                                            <th>Project</th>
                                                            <th>Next Issue title</th>
                                                            <th>Next Issue Assignee</th>
                                                            <th style="display: none"></th>
                                                            <th style="display: none"></th>
                                                            <th style="display: none"></th>
                                                        </tr>
                                                    </thead>
                                                  </table>
                                               </div>
                                            </div>
                                          </div>
                                        </div>              

                                        <br>

                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="pickedissuearea">
                                              <h6>Selected Issue</h6>
                                                
                                                <!-- selection holder table ends -->
                                                <table class="table table-bordered table-striped display table-hover dataTable no-footer" style="background: #fff">
                                                  <thead>
                                                  <tr>
                                                      <th>Issue Title</th>
                                                      <th>Category</th>
                                                      <th>Project</th>
                                                      <th>Next Issue Title</th>
                                                      <th>Next Assignee</th>
                                                  </tr>
                                                  </thead>
                                                  <tbody id="selecetedrowholder">
                                                    {{-- <td id="appholder"></td> --}}
                                                    <td id="issueholer"></td>
                                                    <td id="catholder"></td>
                                                    <td id="projectholder"></td>
                                                    
                                                    <td id="nextissueholder"></td>
                                                    <td id="nextuser"></td>
                                       {{--  issueholer
                                                    projectholder
                                                    catholder
                                                    nextissueholder
                                                    nextuser --}}
                                                  </tbody>
                                                </table>
                                                <!-- selection holder table ends -->
                                            </div>
                                          </div>
                                        </div>

                                        <br>

                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="newassineearea">

                                             
                                                <h6 id="" style="color: white"><span style="color: aquamarine;margin-right: 3px;">Next issue : </span> </h6>
                                             
                                              
                                              <span id="autoassinexistmsg"></span>
                                              <div id="event"></div>
                                              <div id="newassignmsgsuccess"></div>
                                              <div class="input-group">
                                                
                                                <input type="hidden" name="newassignissueid" id="newassignissueid" value="">
                                                <input type="hidden" name="newprojectid" id="newprojectid" value="">

                                          

                                                <select class="custom-select flex-grow-1  mr-3 mb-2" name="newassignee" id="newassignee" style="width: 180px">
                                                  <!-- data will take place here from ajax response -->
                                                </select>

                                                <select class="custom-select flex-grow-1 mr-3 mb-2" name="newstatus" id="newstatus" style="width: 180px">
                                                </select>

                                                <sapn class="flex-grow-1  mr-3 mb-2">
                                                </sapn>
                                              </div>
                                              <div id="newassignmsg"></div>                    
                                              <div class="input-group mt-2">
                                                <sapn class="flex-grow-1  mr-3 mb-2">
                                                  <textarea id="autoassignmsg" name="autoassignmsg" class="form-control newassigneemsgbox" rows="4" style="color:black" placeholder="Write message"></textarea>
                                                </sapn>
                                              </div>                    
                                              <div class="input-group mt-2">
                                                <sapn class="flex-grow-2  mr-3 mb-2">
                                                  <input type="button" class="btn btn-outline primary btn-md py-2" value="Done" id="btnassignnew" style="background: white">
                                                </sapn>
                                              </div>
                                            </div>
                                          </div>
                                        </div> 
                                      </div>
                                    </div>
                                  </div>
                                </div>

                          <!-- ########################## AUTO ASSIGN MODAL ENDS ##############################-->



          @if(session()->has('message'))
            <br>
            <div class="alert alert-success mb-10 background-success" role="alert">
              {{ session()->get('message') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif

{{-- GANTT CHART CODE STARTS --}}
            <div class="ganntcontainer">
                <div class="controls" style="display: block;float: left;">
                {{-- <div class="form-group col-md-5 mt-0">
                      <input type="date" id="" data-date="" data-date-format="YYY,MMMM,DD" name="start_date" class="form-control" value="">
                </div> --}}

            {!! Form::open(['route' => ['ganttdatasend', $id], 'method' => 'POST','files' => true, 'enctype' => 'multipart/form-data','id' => 'reportaddform','class' => 'form-horizontal'])!!}

                    <div class="input-group mb-3" style="float: left;width: 380px;margin-right: 7px;margin-top: -1px;">
                        <div class="input-group-append">
                        <span class="input-group-text" style="background: rgba(24, 28, 33, 0.12);color: #000000b5;">Show from</span>
                      </div>
                      <input type="text" required class="date-own form-control" name="yearofgantt" autocomplete="off" placeholder="Select Year" value="@if (isset($ganttyear)) {{ $ganttyear }} @endif" id="yearlist" style="padding: 19px 13px">
                                        <script>
                                          $( document ).ready(function() {
                                              @if (isset($ganttyear)) 
                                                $('.date-own').datepicker({
                                                  format:'dd/mm/yyyy',
                                                });
                                              @else
                                                $('.date-own').datepicker({
                                                    format:'dd/mm/yyyy',
                                                }).datepicker("setDate",'now');
                                              @endif
                                            });
                                      </script>
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="far fa-calendar-alt d-block"></i></span>
                      </div>
                    </div>

                  <div class="btn-group btn-group-toggle" data-toggle="buttons">
                      <label class="btn btn-default @if (isset($monthlimit) && $monthlimit == 1) active @endif">
                        <input class="monthlimit" style="margin-left: 15px" type="radio" @if (isset($monthlimit) && $monthlimit == 1) checked @endif id="1month" name="scale" value="1" > 1 month
                      </label>
                      <label class="btn btn-default @if (isset($monthlimit) && $monthlimit == 2) active @endif">
                        <input required class="monthlimit" @if (isset($monthlimit) && $monthlimit == 2) checked @endif style="margin-left: 15px" type="radio" id="2month" name="scale" value="2"> 2 months
                      </label>
                      <label class="btn btn-default @if (isset($monthlimit) && $monthlimit == 3) active @endif">
                        <input required class="monthlimit" @if (isset($monthlimit) && $monthlimit == 3) checked @endif style="margin-left: 15px" type="radio" id="3month" name="scale" value="3" > 3 months
                      </label>  

                      <label required class="btn btn-default @if (isset($monthlimit) && $monthlimit == 4) active @endif">
                        <input class="monthlimit" @if (isset($monthlimit) && $monthlimit == 4) checked @endif style="margin-left: 15px" type="radio" id="6month" name="scale" value="4"> 6 months
                      </label>                      

                      <label class="btn btn-default @if (isset($monthlimit) && $monthlimit == 5) active @endif">
                        <input required class="monthlimit" @if (isset($monthlimit) && $monthlimit == 5) checked @endif style="margin-left: 15px" type="radio" id="6month" name="scale" value="5"> 12 months
                      </label>

                  </div>
                <input type="submit" class="btn btn-secondary ml-3 mt-0" id="" value="search" style="padding: 7px 35px;">
                {{-- <a href="{{route('ganttchart', $id)}}" class="btn btn-default ml-3 mt-0">Clear All</a> --}}

            {!! Form::close() !!}

                </div><br>
{{-- 
                  <div class="" style="width: auto;float: right;margin-right: 2px;padding: 7px 4px;">
                        <input class="status" checked style="margin-left: 15px" type="radio"  name="status" value="1" > all
                        <input class="status" style="margin-left: 15px" type="radio" name="status" value="2" > not close
                  </div> --}}

                <div style="clear: both;"></div>
            <div id="gantt_here" style='width:100%;min-height: 580px'></div><br>





{{--################## CUSTOM LIGHT BOX CODE  --}}


            <div id="lightboxform">
              <div class="lightboxinner">
  <input type="button" name="close" value="x" class="lightboxclosebtn" >
              <h4 style="margin-left: -25px; border-bottom: none;" class="card-header">
                   <strong>
                      <a href="#" class="">
                         <div class=" lightboxviewbtn btn-primary btn-sm mt-1  pull-right dtb_custom_btn_default">viwe</div>
                      </a>
                   </strong>
                   <strong>
                      <a href="#">
                         <div class="btn-success lightboxeditbtn mt-1 btn-sm  mr-2 pull-right dtb_custom_btn_default">Edit</div>
                      </a>
                   </strong>
                </h4>
{{-- view portion starts --}}
                <div class="card pb-3 mb-0 bg-transparent border-0 mt-4 lightboxviwpart">

                    <div class="row px-0">
                          <div class="col-md-12">
                            <ul class="appinfobox">
                              <li><span class="issuetitle"></span></li>
                            </ul>
                          </div>
                    </div>                    

                    <div class="row px-0">
                          <div class="col-md-6">
                            <ul class="appinfobox">
                              <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Issue Type</a></li>
                              <li><span class="issuetype badge badge-success p-1"></span></li>
                            </ul>
                          </div>
                          <div class="col-md-6">
                            <ul class="appinfobox">
                              <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">App</a></li>
                              <li><span class="app">Laravel App</span></li>
                            </ul>
                          </div>
                    </div>  
                    <div class="row px-0">
                          <div class="col-md-6">
                            <ul class="appinfobox">
                              <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Status</a></li>
                              <li><span class="status badge text-white p-1"> </span></li>
                            </ul>
                          </div>
                          <div class="col-md-6">
                            <ul class="appinfobox">
                              <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">Priority</a></li>
                              <li><span class="priority badge  p-1">
                            </span></li>
                            </ul>
                          </div>
                    </div> 
                    <div class="row px-0">
                          <div class="col-md-6">
                            <ul class="appinfobox">
                              <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Assign To</a></li>
                              <li><span class="assignee">
                                 
                              </span></li>
                            </ul>
                          </div>
                          <div class="col-md-6">
                            <ul class="appinfobox">
                              <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">Category</a></li>
                              <li><span class="category"></span></li>
                            </ul>
                          </div>
                    </div> 
                    <div class="row px-0">
                          <div class="col-md-6">
                            <ul class="appinfobox">
                              <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Version</a></li>
                              <li><span class="version badge p-1">  </span></li>
                            </ul>
                          </div>
                          <div class="col-md-6">
                            <ul class="appinfobox">
                              <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">Start Date</a></li>
                              <li><span class="startdate">
                                
                              </span></li>
                            </ul>
                          </div>
                    </div> 

                    <div class="row px-0">
                          <div class="col-md-6">
                            <ul class="appinfobox">
                              <li><a href="javascript:void(0)" class="text-body font-weight-semibold">End Date</a></li>
                              <li><span class="enddate">
                               
                              </span></li>
                            </ul>
                          </div>
                          <div class="col-md-6">
                            <ul class="appinfobox">
                              <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">Progress</a></li>
                              <li>
                                  <strong>
                                    <div class="text-right text-muted small progressinfo"></div>
                                    <div class="progress" style="height: 6px;">
                                       <div class="progress-bar"></div>
                                    </div>
                                 </strong>
                              </li>
                            </ul>
                          </div>
                    </div> 

                    <div class="row px-0">
                          <div class="col-md-6">
                            <ul class="appinfobox">
                              <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Estimate 1</a></li>
                              <li><span class="estimate1">
                                  
                                </span></li>
                            </ul>
                          </div>
                          <div class="col-md-6">
                            <ul class="appinfobox">
                              <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">Actual Time</a></li>
                              <li>
                                 <span class="estimate2">
                                 </span>
                              </li>
                            </ul>
                          </div>
                    </div> 

                    <div class="row px-0">
                      <div class="col-md-6">
                        <ul class="appinfobox">
                          <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Difficulty</a></li>
                          <li><span class="difficulty"> 
                           </span></li>
                        </ul>
                      </div>     

                      <div class="col-md-6">
                        <ul class="appinfobox">
                          <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Next Issue</a></li>
                          <li><span class="nextissue"></span></li>
                        </ul>
                      </div>
                    </div>     

                    <div class="row px-0">
                      <div class="col-md-6">
                        <ul class="appinfobox">
                          <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Next Kick Status</a></li>
                          <li><span class="nextissuestats"></span></li>
                        </ul>
                      </div>
                      <div class="col-md-6">
                        <ul class="appinfobox">
                          <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">Next User</a></li>
                          <li><span class="nextuser"></span></li>
                        </ul>
                      </div>
                    </div>                     


                    <div class="row px-0">
                      <div class="col-md-12">
                        <a href="javascript:void(0)" class="text-body font-weight-semibold mr-2 commenttitle">Description</a><br>
                          <div class="desccontent w-100 bg-light"></div>
                      </div>
                    </div> 

                    <div class="row px-0">
                      <div class="col-md-12">
                        <a href="javascript:void(0)" class="text-body font-weight-semibold mr-2 commenttitle">All Comments</a><br>
                            <div style="clear: both;"></div>
                            {{-- <div id="editSection1"></div> --}}
                        {{-- <span class="commentsnode w-100 bg-light"></span> --}}
                        <div id="results"></div>
                        <input type="hidden" id="issueidforcommentsupply" value="">
                        <p></p>
                        {{-- <ul class="appinfobox bg-white p-2">
                          <li><span class="issuecomments"></span></li>
                        </ul> --}}
                      </div>
                    </div> 
                </div>
{{-- view portion ends --}}


{{-- edit form portion starts --}}

                <div class="lightboxeditpart">
                  <br>
                     
                       {!! Form::open()!!}
                          <h4 style="padding: 19px 12px 0px 10px; border-bottom: none;" class="card-header">
                             {{--  <strong><a href="{{url('delete_issue_view/'.$singleissue->id)}}" class="modalLink" data-modal-size="modal-md"><div class="btn-danger btn-sm mt-1  pull-right dtb_custom_btn_default">Delete</div></a></strong>
                          <input type="hidden" name="fromPageDiv" value={{$div}}>
                            <strong><a href="{{url('issue/'. $singleissue->id.'/'.$div)}}"><div class="btn-success mt-1 btn-sm  mr-2 pull-right dtb_custom_btn_default">view</div></a></strong>  
                          <small> --}}
                           
                                        <input id="issuetitle" name="issue_title" type="text" class="col-12 controls form-control {{ $errors->has('issue_title') ? ' is-invalid' : '' }}" placeholder="Subject title" value="{{ old('issue_title') }}" required style="font-size: 16px;float: left;">
                                        <br>
                                        @if ($errors->has('issue_title'))
                                        <span class="invalid-feedback" role="alert">
                                          <span class="messages"><strong>{{ $errors->first('issue_title') }}</strong></span>
                                        </span>
                                        @endif


                          </small>

                          </h4> 

                          <div class="card pb-4 mb-2 mt-4 bg-transparent no_border">
                              <div class="row px-0">
                                    <div class="col-md-6">
                                      <ul class="appinfobox">
                                        <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Issue Type</a></li>
                                        <li><span class="appvalue">

                                        <select id="issuetypes" name="issue_type" class="custom-select {{ $errors->has('issue_type') ? ' is-invalid' : '' }}">
                                          <option value="">Select Issue Type</option>
                                          @foreach($issueTypes as $issueType)
                                          <option value="{{ $issueType->id }}">{{ $issueType->issue_type }}</option>
                                          @endforeach
                                        </select>

                                        </span></li>
                                      </ul>
                                    </div>
                                    <div class="col-md-6">
                                      <ul class="appinfobox">
                                        <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">App</a></li>
                                        <li><span class="appvalue">
                                          <select id="app_ids" name="app_id" class="custom-select {{ $errors->has('app_id') ? ' is-invalid' : '' }}">
                                          <option value="">Select App</option>
                                          @foreach($apps as $app)
                                          <option value="{{ $app->id }}">{{ $app->app_name }}</option>
                                          @endforeach
                                        </select>
                                        </span></li>
                                      </ul>
                                    </div>
                              </div>  

                              <div class="row px-0">
                                    <div class="col-md-6">
                                      <ul class="appinfobox">
                                        <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Status</a></li>
                                        <li><span class="appvalue">
                                           <script type="text/javascript">
                                              var feedbackList = new Array();
                                              </script>
                                       <div class="">
                                        <select name="status" id="status" class="custom-select {{ $errors->has('status') ? ' is-invalid' : '' }}">
                                          <option value="">Select status</option>
                                          @foreach($statuses as $statuse)
                                            @if($statuse->is_feedback == 1)
                                                <script type="text/javascript">
                                                feedbackList.push({{$statuse->id}});
                                                </script>
                                              @endif
                                          <option value="{{ $statuse->id }}" >{{ $statuse->status_name }}</option>
                                          @endforeach
                                        </select>


                                            <select name="feedback_id" id="feedback_id" class="custom-select {{ $errors->has('version_id') ? ' is-invalid' : '' }}">
                                              <option value="">Select Feedback Type</option>
                                              @foreach($feedbacks as $feedback)
                                              <option value="{{ $feedback->id }}" >{{ $feedback->name }}</option>
                                              @endforeach
                                            </select>

                                            <input type="hidden" id="feedbackstatvalue" value="">


                                      <script>

                                        $("#feedback_id").hide();
                                        $('body').on('click','.lightboxeditbtn',function(e){
                                            var statuscheck= $("#status").children('option:selected').val();
                                            var feedstatinput = $("#feedbackstatvalue").val();
                                            if(statuscheck === '43'){
                                              $("#feedback_id").show();
                                            }
                                        });

                                        $('body').on('change','#status',function(e){
                                          e.preventDefault();
                                          var statschangedval = $(this).children('option:selected').val();
                                          if(statschangedval === '43'){
                                              $("#feedback_id").show();
                                          }else{
                                            $("#feedback_id").hide();
                                          }
                                        });

                                      </script>


                                        <input type="hidden" name="next_issue_id" value="">
                                        <input type="hidden" id="next_kick_status" name="next_kick_status" value="">
                                        <input type="hidden" id="next_user_id" name="next_user_id" value="">
                                      </div>

                                        </span></li>
                                      </ul>
                                    </div>
                                    <div class="col-md-6">
                                      <ul class="appinfobox">
                                        <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">Priority</a></li>
                                        <li><span class="appvalue">
                                        <select id="priorities" name="issue_priority_id" class="custom-select {{ $errors->has('issue_priority_id') ? ' is-invalid' : '' }}">
                                          <option value="">Select priority</option>
                                          @foreach($priorities as $priority)
                                          <option value="{{ $priority->id }}">{{ $priority->priority_name }}</option>
                                          @endforeach
                                        </select>
                                        </span></li>
                                      </ul>
                                    </div>
                              </div>

                              <div class="row px-0">
                                    <div class="col-md-6">
                                      <ul class="appinfobox">
                                        <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Assign To</a></li>
                                        <li><span class="appvalue">

                                          <select id="userids" name="user_id" class="custom-select {{ $errors->has('user_id') ? ' is-invalid' : '' }}">
                                            <option value="">Select to assign</option>
                                            @foreach($users as $user)

                                     {{-- code for: if the assigned user is already archived, the person is selectable unless someone changed the assignee to other user who has not been archived yet --}}

                                           {{--  @if ($user->is_archived == 1 && $singleissue->user_id == $user->user_id)
                                              <option value="{{ $user->user_id }}" {{ old('user_id') == $user->user_id || $singleissue->user_id == $user->user_id ? 'selected':'' }}>{{ $user->name }} (archived)</option>
                                            @elseif($user->is_archived == 0)
                                              <option value="{{ $user->user_id }}" {{ old('user_id') == $user->user_id || $singleissue->user_id == $user->user_id ? 'selected':'' }}>{{ $user->name }}</option>
                                            @endif --}}

                                            <option value="{{ $user->user_id }}" >{{ $user->name }} </option>

                                            @endforeach
                                          </select>

                                        </span></li>
                                      </ul>
                                    </div>
                                    <div class="col-md-6">
                                      <ul class="appinfobox">
                                        <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">Category</a></li>
                                        <li><span class="appvalue">
                                       <div class="">
                                        <select id="categoryids" name="category_id" class="custom-select {{ $errors->has('category_id') ? ' is-invalid' : '' }}">
                                          <option value="">Select Category</option>
                                          @foreach($categories as $category)
                                          <option value="{{ $category->id }}" >{{ $category->category_name }}</option>
                                          @endforeach
                                        </select>
                                        {{-- <input type="hidden" name="next_kick_status" value=""> --}}
                                      </div>
                                        </span></li>
                                      </ul>
                                    </div>
                              </div>

                              <div class="row px-0">

                                    <div class="col-md-6">
                                      <ul class="appinfobox">
                                        <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">Start Date</a></li>
                                        <li><span class="appvalue">
                                          <div class="">
                                            <input type="text" data-date="" data-date-format="YYY MMMM DD" name="start_date" id="start_date" class="form-control  {{ $errors->has('start_date') ? ' is-invalid' : '' }}" placeholder="Start Date" value="" autocomplete="false">
                                          </div>
                                        </span></li>
                                      </ul>
                                    </div>
                                    <div class="col-md-6">
                                      <ul class="appinfobox">
                                        <li><a href="javascript:void(0)" class="text-body font-weight-semibold">End Date</a></li>
                                        <li><span class="appvalue">

                                           <input name="deadline" id="deadline" type="text" data-date="" data-date-format="YYY MMMM DD" class="form-control  {{ $errors->has('deadline') ? ' is-invalid' : '' }}" placeholder="End Date" value="" autocomplete="false">

                                        </span></li>
                                      </ul>
                                    </div>
                              </div>
                            
                              <div class="row px-0">
                                    <div class="col-md-6">
                                      <ul class="appinfobox">
                                        <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Version</a></li>
                                        <li><span class="appvalue">

                                       <div class="">

                                        <select id="issueversion" name="version_id" class="custom-select {{ $errors->has('version_id') ? ' is-invalid' : '' }} ">
                                          <option value="">Select Version</option>
                                          @foreach($versions as $version)
                                          <option value="{{ $version->id }}" >{{ $version->version_name }}</option>
                                          @endforeach
                                        </select>

                                        </div>

                                        </span></li>
                                      </ul>
                                    </div>
                                    <div class="col-md-6">
                                      <ul class="appinfobox">
                                        <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">Progress</a></li>
                                        <li><span class="appvalue">
                                       <div class="">
                                         <select id="progresses" name="progress" class="custom-select {{ $errors->has('progress') ? ' is-invalid' : '' }}">
                                          <option value="">Select Progress</option>
                                          <option value="1">10%</option>
                                          <option value="2">20%</option>
                                          <option value="3">30%</option>
                                          <option value="4">40%</option>
                                          <option value="5">50%</option>
                                          <option value="6">60%</option>
                                          <option value="7">70%</option>
                                          <option value="8">80%</option>
                                          <option value="9">90%</option>
                                          <option value="10">100%</option>
                                        </select>
                                      </div>
                                        </span></li>
                                      </ul>
                                    </div>
                              </div>

                              <div class="row px-0">
                                    <div class="col-md-6">
                                      <ul class="appinfobox">
                                        <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Estimate 1</a></li>
                                        <li><span class="appvalue">

                                        <div class="">
                                          @if(Session::has('role'))
                                          @if(Session::get('role') == '0')
                                             <input id="estimatehours1" type="text" name="estimate_hour1" class="form-control  {{ $errors->has('estimate_hour1') ? ' is-invalid' : '' }}" placeholder="Estimate Hour One" value="{{ old('estimate_hour1')}}">
                                          @endif
                                          @endif
                                        </div>

                                        </span></li>
                                      </ul>
                                    </div>
                                    <div class="col-md-6">
                                      <ul class="appinfobox">
                                        <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">Actual Time</a></li>
                                        <li><span class="appvalue">
                                         <div class="">
                                              <input id="estimatehours2" type="text" name="estimate_hour2" class="form-control  {{ $errors->has('estimate_hour2') ? ' is-invalid' : '' }} estimte1" value="{{ old('estimate_hour2')}}" placeholder="Estimate Hour Two">
                                          </div>
                                        </span></li>
                                      </ul>
                                    </div>
                              </div>    

                              <div class="row px-0">
                                    <div class="col-md-6">
                                      <ul class="appinfobox">
                                        <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Difficulty</a></li>
                                        <li><span class="appvalue">

                                        <div class="">
                                         <select id="difficulties" name="difficulty" class="custom-select {{ $errors->has('difficulty') ? ' is-invalid' : '' }}">
                                          <option value="">Select Difficulty</option>
                                          <option value="1">Easy</option>
                                          <option value="2">Medium</option>
                                          <option value="3">Hard</option>
                                        </select>
                                      
                                        </div>

                                        </span></li>
                                      </ul>
                                    </div>
                                    <div class="col-md-6">
                                      <ul class="appinfobox">
                                        <li> <a href="javascript:void(0)" class="text-body font-weight-semibold"></a></li>
                                        <li><span class="appvalue">
                                         <br><br>
                                        </span></li>
                                      </ul>
                                    </div>
                              </div>


                          <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                              <button type="button" id="autoassignmodalbtn" class="btn btn-info btn-sm pull-right dtb_custom_btn_default dtb_secondary_bgcolor text-white" data-toggle="modal" data-target="#myModal">Auto assign</button>
                            </div>
                          </div>


                              <div class="row px-0">
                                    <div class="col-md-12">
                                      <ul class="appinfobox">
                                        <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Next Issue</a></li>
                                        <li><span class="appvalue">

                                        <div class="nextissue">
                                        <span></span>

                                        </div>

                                        </span></li>
                                      </ul>
                                    </div>
                              </div>

                              <div class="row px-0">
                                    <div class="col-md-6">
                                      <ul class="appinfobox">
                                        <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Next Kick Status</a></li>
                                        <li><span class="appvalue">

                                        <div class="nextstat">
                                          <span></span>
                                        </div>

                                        </span></li>
                                      </ul>
                                    </div>
                                    <div class="col-md-6">
                                      <ul class="appinfobox">
                                        <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">Next User</a></li>
                                        <li><span class="appvalue">
                                         <div class="nextuser">
                                             <span></span>
                                          </div>
                                        </span></li>
                                      </ul>
                                    </div>
                              </div>

                          <div class="row no-gutters align-items-center mt-2 px-2">
                          <div class="col-lg-12" style="padding: 7px 0px;">
                           <a href="javascript:void(0)" class="text-body font-weight-semibold">Issue Detail</a>

                          


                          </div>
                           <div id="editSection" class="mt-2" style="width: 100%"></div>
                           <textarea id="issuedesctobesaved" rows="10" cols="82" name="issue_text" style="display: none;"></textarea> 
                          <textarea style="display: none;" id="wikidescsrc" rows="10" cols="82"></textarea>

                          <input type="hidden" name="feedback_type" id ="feedback_type"></input>

                          </div>
                          </div>

                           {{--  <div class="container-fluid flex-grow-1 container-p-y px-0 pt-2">
                            <div class="form-group">
                               <label class="form-label mt-3 mb-2"><h4>Write a Comment</h4></label>
                               @if ($errors->has('description'))
                               <span class="invalid-feedback" role="alert">
                                <span class="messages"><strong>{{ $errors->first('description') }}</strong></span>
                              </span>
                              @endif
                              <div id="editSection1"></div>
                              <textarea id="content2bSavedHolder" name="issue_comment" style="display:none"></textarea>
                            </div>
                            </div> --}}


                            <div class="row mb-4">
                            
                              <div class="col-md-10 text-center">
                               <input type="button" name="save" value="Save" id='savebtnModel'  style="width:100px;"  class="btn btn-success dtbbigbtn mr-2 updatebtn" >

                            </div>
                            <div class="col-md-2 text-center">
                               <input type="button" name="delete" value="Delete" class="delissuebtn" style="width:100px;">
                            </div>
                            <div class="col-md-1"></div>
                          </div>
                        </div>
                            



                          {{ Form::close()}}
                          
                          

                </div>

{{-- edit form portion ends --}}
               </div>     
            </div>
{{-- CUSTOM LIGHT BOX CODE ENDS  --}}


<!-- Modal for feedback -->

                      <div class="modal fade" id="feedbackmodal">
                        <div class="modal-dialog modal-lg">
                          <form method="POST" class="modal-content" id="issuetypupdate">

                            <div class="modal-header">
                              <h5 class="modal-title">
                                Feedback Type
                              </h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">✖</button>
                            </div>
                            <div class="modal-body">

                                  <div class="errmsg alert alert-danger" style="display:none">
                                      <ul>
                                          {{-- @foreach ($errors->all() as $error) --}}
                                              <li>{{-- {{ $error }} --}}</li>
                                          {{-- @endforeach --}}
                                      </ul>
                                  </div>

                            <div class="modal-footer">
                              <button id="feedbackclosebtn" class="btn btn-default" data-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-primary updatewithfeedbackbtn" disabled="disabled">Save</button>
                            </div>
                          </form>
                        </div>
                      </div>
                      
{{-- code for feedback modal end --}}

{{-- GANTT CHART CODE ENDS --}}

     
            </div>
         </div>
        
      </div>
   </div>
</div>




{{-- supplied for javascript section  --}}

<input type="hidden" id="issueidforautoassign" type="text">
<input type="hidden" id="issuedescholder" type="text">

{{-- supplied for javascript section  --}}




<script src="{{asset('js/ganttchart/ganttmain.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/ganttchart/ganttmain.css')}}">
<link rel="stylesheet" href="{{asset('css/ganttchart/ganttchartnewdesign.css')}}">
{{-- <script src="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.js"></script>
<link href="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.css" rel="stylesheet"> --}}
{{-- <link href="https://docs.dhtmlx.com/gantt/codebase/skins/dhtmlxgantt_broadway.css?v=6.3.7" rel="stylesheet"> --}}


<link rel="stylesheet" href="{{asset('css/for_marked/bootstrap-markdown.min.css')}}" />
<link rel="stylesheet" href="{{asset('css/for_marked/style.css')}}" />
<script src="{{asset('/assets/js/showdown.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/for_marked/codemirror.css')}}" />
<link rel="stylesheet" href="{{asset('css/for_marked/github.min.css')}}" />
<link rel="stylesheet" href="{{asset('tui-editor/css/tui-editor.css')}}" />
<link rel="stylesheet" href="{{asset('tui-editor/css/tui-editor-contents.css')}}" />
<script src="{{asset('js/for_marked/tui-editor-Editor-full.js')}}"></script>


<script type="text/javascript">

  $( document ).ready(function() {






      <?php
       if (isset($issuedata)) { ?>
        

            var monthlimit = parseInt({{ $monthlimit }});
            var year = '<?php echo $ganttyear; ?>';
            var tasks = <?php echo $issuedata; ?>


            gantt.config.order_branch_free = true;
            var index = gantt.getColumnIndex("start_date");
            gantt.config.xml_date = "%Y-%m-%d";
            gantt.config.date_grid = "%d-%m-%Y";

            gantt.config.scales = [
              { unit: "month", step: 1, date: "%F, %Y" },
              { unit: "day", step: 1, date: "%d" }
            ];

            gantt.config.drag_progress = false;
            gantt.config.min_column_width = 30;
            
            var formatFunc = gantt.date.str_to_date("%d/%m/%Y");
            var userdate = formatFunc(year);

            var monthStart = userdate;
            var monthEnd = gantt.date.add(monthStart, monthlimit, "month");
            
            var dataRange = gantt.getSubtaskDates();

            var newStart = dataRange.start_date ? Math.min(+dataRange.start_date, +monthStart) : +monthStart;
            var newEnd = dataRange.end_date ? Math.max(+dataRange.end_date, +monthEnd) : +monthEnd;

            gantt.config.start_date = new Date(monthStart);
            gantt.config.end_date = new Date(monthEnd);
            gantt.config.show_errors = false;
            gantt.config.autosize = "x,y";
            // gantt.config.autosize_min_width = 800;





//############## code for custom lightbox for view and edit starts

    $('.lightboxviwpart').show();
    $('.lightboxeditpart').hide();

    $('.lightboxeditbtn').click(function(e){
      e.preventDefault();
      $('.lightboxeditpart').show();
      $('.lightboxviwpart').hide();
    });    


// MODAL TASK VIEW AJAX STARTS
    $('.lightboxviewbtn').click(function(e){
      e.preventDefault();
      $('.lightboxeditpart').hide();
      $('.lightboxviwpart').show();

    });
// MODAL TASK VIEW AJAX ENDS



(function(){

      var taskId = null;
      var newTask = 0;

      gantt.showLightbox = function(id) {

           taskId = id;
           var data = gantt.getTask(id);
           var form = getForm();
           // var title = form.querySelector("[name='description']");
           // title.focus();
           // title.value = data.text;
           //console.log(data);


          var $startdates = $('#start_date');
          $startdates.datepicker();
          $startdates.datepicker('setDate', data.datestart);

          var $enddates = $('#deadline');
          $enddates.datepicker();
          $enddates.datepicker('setDate', data.dateend);


//set values to show datas in lightbox view mode
                             var issuetitle =     $('.issuetitle').text(data.text);
                             var issuetype =      $('.issuetype').text(data.typeofissue);
                             var issuetypecolor = $('.issuetype').css("background-color", data.issuetypecolor);
                             var app =            $('.app').text(data.appname);
                             var status =         $('.status').text(data.statusname);
                             var statuscolor =    $('.status').css("background-color", data.statuscolor);
                             var priority =       $('.priority').text(data.priorname);
                             var prioritycolor =  $('.priority').css("background-color", data.priorcolor);
                             var category =       $('.category').text(data.categoryname);
                             var assignee =       $('.assignee').text(data.assignee);
                             var version =        $('.version').text(data.versionname);
                             var versioncolor =   $('.version').css("background-color", data.versioncolor);
                             var startdate =      $('.startdate').text(data.datestart);
                             var enddate =        $('.enddate').text(data.dateend);
                             var progressbar =    $('.progress-bar').css("width", data.progress+"0%");
                             var progress =       $('.progressinfo').text(data.progress+"0%");
                             if(data.estimate_hour1 ==null){ est1 = "not set" }else{ var est1 = data.estimate_hour1 + " hours" }
                             var estimate1 =      $('.estimate1').text(est1);
                             if(data.estimate_hour2 ==null){ est2 = "not set" }else{ var est2 = data.estimate_hour2 + " hours" }
                             var estimate2 =      $('.estimate2').text(est2);
                             var difficulty =     $('.difficulty').text(data.difficname);
                             var nextissue =      $('.nextissue').text(data.nextissuetitle);
                             var nextissuestats = $('.nextissuestats').text(data.nextissuestat);
                             var nextstatcolor =  $('.nextissuestats').css("background",data.nextissuestatcolor);
                             $('.nextstat').text(data.nextissuestat);
                             var nextuser =       $('.nextuser').text(data.nexissueassignee);
                             var issuecomments =  $('.issuecomments').text(data.issue_comment);
//set values to show datas in lightbox view mode end



//make data selected or filled by taskdata at form inputs
                              $('#issuetitle').val(data.text);
                              $('#start_date').val(data.datestart);
                              $('#deadline').val(data.dateend);
                              $('#estimatehours1').val(data.estimate_hour1);
                              $('#estimatehours2').val(data.estimate_hour2);
                              $('#issuedesctobesaved').val(data.issue_text);
                              //$('#content2bSavedHolder').val(data.end_date);
                              $(document).ready(()=>{ 
                                  $("#issuetypes").val(data.issue_type); 
                              }); 
                              $(document).ready(()=>{ 
                                  $("#issueversion").val(data.version_id); 
                              });
                              $(document).ready(()=>{ 
                                  $("#app_ids").val(data.app_id); 
                              });
                              $(document).ready(()=>{ 
                                  $("#status").val(data.status); 
                              });
                              // $(document).ready(()=>{ 
                              //     $("#feedback_id").val(data.feedback_id); 
                              // });

                              $(document).ready(()=>{ 
                                  $("#priorities").val(data.issue_priority_id); 
                              });
                              $(document).ready(()=>{ 
                                  $("#userids").val(data.user_id); 
                              });
                              $(document).ready(()=>{ 
                                  $("#categoryids").val(data.category_id); 
                              });
                              $(document).ready(()=>{ 
                                  $("#issueversion").val(data.version_id); 
                              });
                              $(document).ready(()=>{ 
                                  $("#progresses").val(data.progress); 
                              });
                              $(document).ready(()=>{ 
                                  $("#difficulties").val(data.difficulty); 
                              });
                              // $(document).ready(()=>{ 
                              //     $("#feedback_id").val(data.feedback_type); 
                              // });
//make data selected or filled by datadata in form inputs ends



// ##################  Imidate call for getting issue comments when lightbox opened start
                              var issueidforcomment = $("#issueidforcommentsupply").val();
                              $.ajaxSetup({
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                              });
                              $.ajax({
                              url: 'ganttdata',
                              type: 'GET',
                              data:{taskid:issueidforcomment},
                              success: function(data){
                                $("#results").empty();
                                $("#results").append(data);
                              },
                              error: function (request, status, error) { 
                              }

                              });

// ################  Imidate call for getting issue comments when lightbox opened ends


//#######Showdown apply for issue description
          $('.desccontent').empty();
          $(".desccontent").append(
                  target = document.getElementsByClassName('desccontent'),
                  converter = new showdown.Converter(),
                  converter.makeHtml(data.issue_text),
                  target.innerHTML = html
          );
//##########Showdown apply for issue description ends   



         var text = data.issue_text,
          target = document.getElementById('editSection'),
          converter = new showdown.Converter(),
          html = converter.makeHtml(text);
          target.innerHTML = html;
          var initcontent = [].join('\n');
          if (text.length>0)
            initcontent = [];


            var editor = new tui.Editor({
            el: document.querySelector('#editSection'),
            height: '250px',
            previewStyle: 'vertical',
            initialValue: initcontent+text,
            exts: [
            {
              name: 'chart',
              minWidth: 100,
              maxWidth: 600,
              minHeight: 100,
              maxHeight: 300
            },
            'scrollSync',
            'colorSyntax',
            'uml',
            'mark',
            'table'
            ],
            hooks: {
                    addImageBlobHook: function (blob, callback) {
                        var myupload = ImageUpload(blob);
                        //console.log(blob);
                        var cllbackimg = myupload;
                        //var cllbackimg = document.location.origin +'/developmentmanage/public/'+myupload;
                        callback(cllbackimg, 'alt text');
                    }
                }
          });


        $(".updatebtn").click(function(e){
          e.preventDefault();
          var issue_details = editor.getValue();
          //var content2bSaved = editor.getHtml();
          $('#issuedesctobesaved').html(issue_details);
        });

                              //console.log(data);
                              form.style.display = "block"; 
                              form.querySelector("[name='save']").onclick = save;
                              form.querySelector("[name='close']").onclick = cancel;
                              form.querySelector("[name='delete']").onclick = remove;



      };


      
            gantt.hideLightbox = function(){
              getForm().style.display = ""; 
              taskId = null;
            }
             
            function getForm() { 
            return document.getElementById("lightboxform"); 
            }; 
            function save() {
                var task = gantt.getTask(taskId);
                //var title  = task.text = getForm().querySelector("[name='start_date']").value;



            if(newTask){
                //alert('new task');die();
                gantt.addTask(task,task.parent);
            }else{
                gantt.updateTask(task.id);
            }
                gantt.hideLightbox();
            }
            function cancel() {
                var task = gantt.getTask(taskId);

            if(newTask)
                gantt.deleteTask(task.id);
                gantt.hideLightbox();
            }
            function remove() {
                gantt.deleteTask(taskId);
                gantt.hideLightbox();
            }



})();

//################# code for custom lightbox for view and edit ends ##############



//main initialization of gantt chart ##################
            gantt.init("gantt_here");
            //gantt.init("gantt_here",new Date(2019,10,28), new Date(2020,monthlimit,30));
            gantt.parse({
              data: tasks
            });
            var dp = new gantt.dataProcessor("ganttchart");
            dp.init(gantt);
            dp.setTransactionMode({
            }, true);
            gantt.config.columns = [
              // {name:"text",       label:textFilter, width:250, tree:true },
              {name:"text",       label:"Issue Title", width:180, tree:true },
              {name:"start_date", label:"Start at", width:80, align:"center" },
              {name:"duration",   label:"Day",   width:40, align:"center" },
              {name:"add",        label:"", width:40, align:"left" },
            ];

            gantt.templates.rightside_text = function(start, end, task){
                return "<b style='color:#05244b;padding: 3px 5px;background: #dcff50;font-weight: 500'>Assignee </b>" + "<span style='color:#f1f1f2;padding: 3px 8px;background: #38587d;font-weight: bold;text-transform:capitalize'>" + task.assignee + "</span>";
            };
            gantt.templates.tooltip_text = function(start,end,task){
                return " ";
            };
            gantt.templates.grid_header_class = function(columnName, column){
              if(columnName == 'duration' ||columnName == 'text')
                return "updColor";
            };
            gantt.templates.task_text=function(start, end, task){
                return task.issue_title;
            };

            dp.attachEvent("onAfterUpdate", function(id, action, tid, response){
                   //gantt.refreshTask(5256);
                   // gantt.refreshData();
                   //  gantt.init('gantt_here');
                   //  gantt.render();
                    //gantt.refreshData();
                    //window.location.reload();
                if(action == "error"){
                }
            });

            gantt.attachEvent("onAfterTaskDrag", function(id, mode, e){
                var modes = gantt.config.drag_mode;
                switch (mode){

                case modes.move:
                  //window.location.reload();
                break;
                case modes.resize:
                  //window.location.reload();
                break;
                case modes.progress:
                break;

              }
            });
            // gantt.attachEvent("onBeforeRowDragMove", function(id, parent, tindex){
            //    alert('daraged');exit();
            // });
            // gantt.attachEvent("onBeforeRowDragEnd", function(id, parent, tindex){
            //    alert('edd');exit();
            // });

            // gantt.attachEvent("onBeforeTaskDrag", function(id, mode, e){
            // });
            gantt.attachEvent("onTaskSelected", function(id){
              taskId = id;
              var supplytask = gantt.getTask(id);
              $("#issueidforautoassign").val(supplytask.id);
              $("#issueidforcommentsupply").val(supplytask.id);
              $("#issuedescholder").val(supplytask.issue_text);
              $("#issuedesctobesaved").val(supplytask.issue_text);
            });
            // gantt.attachEvent("onBeforeTaskChanged", function(id, mode, data){
            //     alert(mode);
            // });

            gantt.attachEvent("onBeforeRowDragMove", function(id, mode, e){
                // alert(mode);
                // taskId = id;
                // var task = gantt.getTask(id);
                // alert(task.end_date);
                // $('#deadline').val(task.end_date).datepicker("update");
                // var test =  $("#deadline").data('datepicker').getFormattedDate('yyyy-mm-dd');
                // alert(test);
                // var dd = $("#deadline").val();
                // alert(dd);
            });
       <?php }else{ ?>

          // var currentyear = new Date().getFullYear();
          // ganttchartrunner(year=currentyear,monthlimit=12);

      <?php } ?>


        gantt.createDataProcessor(function(entity, action, data, id){
         
          switch (action) {

            case "update":
                  //console.log(data);
                 // taskId = id;
                 // var task = gantt.getTask(id);



// set data for ajax data that will be sent to controller for update.
//Condition: when tsak draged or resized , value not find from form input, so checking is, if form input value empty set data to variable by task object data,like task.start_date.

                  //var title  = task.text =  getForm().querySelector("[name='start_date']").value;
                  if(document.querySelector("[name='issue_title']").value == ""){
                     var issue_title_val = data.text;
                  }else{
                    var issue_title_val  = document.querySelector("[name='issue_title']").value;
                  }
                  if(document.querySelector("[name='issue_type']").value == ""){
                    var issue_type_val  = data.issue_type;
                  }else{
                    var issue_type_val  = document.querySelector("[name='issue_type']").value;
                  }
                  if(document.querySelector("[name='app_id']").value == ""){
                    var app_id_val  = data.app_id;
                  }else{
                    var app_id_val  = document.querySelector("[name='app_id']").value;
                  }
                  if(document.querySelector("[name='status']").value == ""){
                    var status_val  = data.status;
                  }else{
                    var status_val  = document.querySelector("[name='status']").value;
                  }

                  if(document.querySelector("[name='next_issue_id']").value == ""){
                    var next_issue_id_val  = data.next_issue_id;
                  }else{
                    var next_issue_id_val  = document.querySelector("[name='next_issue_id']").value;
                  }
                  if(document.querySelector("[name='next_kick_status']").value == ""){
                    var next_kick_status_val  = data.next_kick_status;
                  }else{
                    var next_kick_status_val  =  document.querySelector("[name='next_kick_status']").value;
                  }

                  if(document.querySelector("[name='next_user_id']").value == ""){
                    var next_user_id_val  = data.next_user_id;
                  }else{
                    var next_user_id_val  = $("#next_user_id").val();
                  }


                  if(document.querySelector("[name='issue_priority_id']").value == ""){
                     issue_priority_id_val  = data.issue_priority_id;
                  }else{
                     issue_priority_id_val  =  document.querySelector("[name='issue_priority_id']").value;
                  }
                  if(document.querySelector("[name='user_id']").value == ""){
                    var user_id_val  = data.user_id;
                  }else{
                    var user_id_val  =  document.querySelector("[name='user_id']").value;
                  }
                  if(document.querySelector("[name='category_id']").value == ""){
                    var category_id_val  = data.category_id;
                  }else{
                    var category_id_val  = document.querySelector("[name='category_id']").value;
                  }


                  var datestrat = $("#start_date").data('datepicker').getFormattedDate('yyyy-mm-dd');
                  if(datestrat == ""){
                    var start_date_val  = data.start_date;
                  }else{
                    var start_date_val  = $("#start_date").data('datepicker').getFormattedDate('yyyy-mm-dd');
                  }

                  var dateend = $("#deadline").data('datepicker').getFormattedDate('yyyy-mm-dd');
                  if(dateend == ""){
                    //alert(dateend+'khali');
                    var deadline_val = data.end_date;
                  }else{
                    //alert(dateend+'vra');
                    var deadline_val  = $("#deadline").data('datepicker').getFormattedDate('yyyy-mm-dd');
                  }


                  if(document.querySelector("[name='version_id']").value == ""){
                    var version_id_val = data.version_id;
                  }else{
                    var version_id_val  = document.querySelector("[name='version_id']").value;
                  }

                  if(document.querySelector("[name='progress']").value == ""){
                    var progress_val  = data.progress;
                  }else{
                    var progress_val  = document.querySelector("[name='progress']").value;
                  }

                  if(document.querySelector("[name='estimate_hour1']").value == ""){
                    var estimate_hour1_val = data.estimate_hour1;
                  }else{
                    var estimate_hour1_val  = document.querySelector("[name='estimate_hour1']").value;
                  }

                  var estimate2 = document.querySelector("[name='estimate_hour2']").value;
                  if(estimate2 == ""){
                    var estimate_hour2_val  = data.estimate_hour2;
                    //alert(estimate_hour2_val);
                  }else{
                    var estimate_hour2_val  = document.querySelector("[name='estimate_hour2']").value;
                    //alert(estimate_hour2_val);
                  }

                  if(document.querySelector("[name='difficulty']").value == ""){
                    var difficulty_val  = data.difficulty;
                  }else{
                    var difficulty_val  = document.querySelector("[name='difficulty']").value;
                  }

                  if(document.querySelector("[name='project']").value == ""){
                     var project_val  = data.project_id;
                  }else{
                    var project_val  = document.querySelector("[name='project']").value;
                  }
                  var issuedescfinal = $("#issuedesctobesaved").text();
                  if(issuedescfinal == ""){
                    var issue_text_val  = data.issue_text;
                  }else{
                    var issue_text_val  =  $("#issuedesctobesaved").text();
                  }
                  if(document.querySelector("[name='feedback_type']").value == ""){
                    var feedback_type_val  =  "";
                  }else{
                    var feedback_type_val  =  document.querySelector("[name='feedback_type']").value;
                  }
                  var feedback_id = $("#feedback_id").children('option:selected').val();
                  if(feedback_id == ""){
                    var feedback_type_val  = data.feedback_type;
                  }else{
                    var feedback_type_val  = $("#feedback_id").children('option:selected').val();
                  }

                  //alert(next_user_id_val);

                  $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                  });
                  //console.log(data);
                  $.ajax({
                  url: 'task/'+id,
                  type: 'PUT',
                  data:{
                    taskid:data.id,
                    issue_id:data.id,
                    user_id:user_id_val,
                    issue_title:issue_title_val,
                    //start_date:data.start_date,
                    start_date:start_date_val,
                    deadline:deadline_val,
                    complete_date:data.complete_date,
                    progress:data.progress,
                    duration:data.duration,
                    updated_at:data.updated_at,
                    issue_type_val:issue_type_val,
                    app_id_val:app_id_val,
                    status_val:status_val,
                    next_issue_id_val:next_issue_id_val,
                    next_kick_status_val:next_kick_status_val,
                    next_user_id_val:next_user_id_val,
                    issue_priority_id_val:issue_priority_id_val,
                    category_id_val:category_id_val,
                    version_id_val:version_id_val,
                    progress_val:progress_val,
                    estimate_hour1_val:estimate_hour1_val,
                    estimate_hour2_val:estimate_hour2_val,
                    difficulty_val:difficulty_val,
                    project_val:project_val,
                    issue_text_val:issue_text_val,
                    feedback_type_val:feedback_type_val,
                    feedback_type:feedback_type_val,
                    //issue_comment_val:issue_comment_val
                  },
                  success: function(data){
                     //alert(data);exit();
                      gantt.render();
                      gantt.refreshData();
                      
                    $.iaoAlert({msg: "Issue has been Updated !",
                      type: "success",
                      mode: "dark",});

                    //window.location.reload();
                      setTimeout(function () {
                       window.location.reload();
                    }, 1000);

                  },
                  error: function (request, status, error) { 
                  }

                  });


          break;


            case "create":
                 // alert('creat');die();
                  $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                  });

                  $.ajax({
                  url: 'task',
                  type: 'POST',
                  data:{start_date:data.start_date,issue_title:data.text,duration:data.duration,end_date:data.end_date},
                  success: function(data){

                    gantt.load("ganttdata");
                    gantt.render();

                    $.iaoAlert({msg: "Issue has been Saved !",
                    type: "success",
                    mode: "dark",});

                    window.location.reload();
                    gantt.render();

                  //   setTimeout(function () {
                  //     window.location.reload();
                  // }, 2000);

                  },
                  error: function (request, status, error) { 
                    alert('error');
                  }

                  });


          break;


            case "delete":

                  $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                  });
                  $.ajax({
                  url: 'task/'+id,
                  type: 'DELETE',
                  data:{taskid:data.id},
                  success: function(data){

                    $.iaoAlert({msg: "Issue has been deleted !",
                    type: "success",
                    mode: "dark",});
                    gantt.load("ganttdata");
                    gantt.render();

                  },
                  error: function (request, status, error) { 
                  }

                  });

            break;

          }
        });



// GANTT CHART CODE ENDS ##############################


//start end date calender
        $( function() {
            $( "#start_date" ).datepicker({
              format: 'yyyy-mm-dd',
              todayBtn: true,
                clearBtn: true,
                autoclose: true,
                todayHighlight: true
            });
          } );
        $( function() {
            $( "#deadline" ).datepicker({
              format: 'yyyy-mm-dd',
              todayBtn: true,
                clearBtn: true,
                autoclose: true,
                todayHighlight: true
            });
          } );

        });






//AUTO ASSIGN MODAL CODE START #######################

      var issueidforautoassign = $("#issueidforautoassign").val();
      var issuedescholder = $("#issuedescholder").val();
      $("#autoassignmodalbtn").click(function(){
      });
      $('#myModal').on('shown.bs.modal', function () {
        $("#lightboxform").css("visibility", 'hidden');
      });

      $('#myModal').on('hidden.bs.modal', function () {
        $("#lightboxform").css("visibility", 'visible');
      });




// ######################   auto assign poriton starts ##############

  $("#project").change(function(e){
    e.preventDefault();

          let selectedproject = $(this).find(":selected").val();

            $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });

            if (selectedproject !== "") {

                $.ajax({
                  url : '{{ url('/getprojectapp') }}',
                  method: 'POST',
                  data: {
                    "selectedprojectid": selectedproject
                  },
                    success: function (response) {

                    $("#app").empty();
                    $("#app").append('<option> Select App </option>');

                    if(response)
                    {
                      $.each(response,function(key,value){
                          $('#app').append($("<option/>", {
                             value: key,
                             text: value
                          }));
                          //console.log(key);
                      });
                    }

                    getprojectuser(selectedproject);

                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                      alert('something went wrong');
                    }
                });

            }else{
              $("#app").empty();
            }

  });



// ######################   auto assign get user starts ##############

            function getprojectuser(selectedproject){

              $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });

              $.ajax({
                  url : '{{ url('/getprojectaddeduser') }}',
                  method: 'POST',
                  data: {
                    "selectedprojectid": selectedproject
                  },
                  success: function (data) {

                    $("#assignee").empty();
                    $("#assignee").append('<option> Select User </option>');

                        if(data)
                        {
                          $.each(data,function(key,value){
                            //console.log(key);
                              $('#assignee').append($("<option/>", {
                                 value: key,
                                 text: value
                              }));
                          });
                      }

                  },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                      alert('something went wrong');
                    }
                });
            }


        </script>



        <script>
          
// #####################  serch issue for auto assign functionality ########################

        $(document).ready(function(){ 


            // $("#autoassigntitle").text('Set Next Assignee');
            // $("#autoassinexistmsg").text('');

            $("#newassignmsgsuccess").hide();

            fill_datatable();
            
            function fill_datatable(project = '', app = '' ,assignee = '')
            {
                var dataTable = $('#autoassignsrchrslt').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax:{
                        url: "{{ route('customsearch') }}",
                        data:{project:project, app:app,assignee:assignee,issue_id:issueidforautoassign}
                    },
                    columns: [
                        {
                            data:'id',
                            name:'id'
                        },
                        {
                            data:'issue_title',
                            name:'issue_title'
                        },
                        {
                            data:'category_name',
                            name:'category_name'
                        },
                        {
                            data:'project_name',
                            name:'project_name'
                        },
                        {
                            data:'nxtissuetitles',
                            name:'nxtissuetitles'
                        },
                        {
                            data:'nextissueassignee',
                            name:'nextissueassignee'
                        },
                        {
                            data:'project_id',
                            name:'project_id',
                            
                        },
                        {
                            data:'nextkcikstatusid',
                            name:'nextkcikstatusid',
                            visible : false
                        },
                        {
                            data:'nextissueassigneeid',
                            name:'nextissueassigneeid',
                            visible : false
                        }
                    ]
                });

                  // var nextassignee = dataTable.column( 'nextissueassigneeid:name' ).data();
                  // if(nextassignee == null && nextassignee == null){
                  //     $("#autoassigntitle").text(' Set Next Assignee');
                  //     $("#autoassinexistmsg").text('');
                  //   } 
                  //   else{
                  //     $("#autoassigntitle").text('Edit Next Assignee');
                  //     $("#autoassinexistmsg").text('Next assignee already asigned for this issue,you can edit.');
                  // }

            }



              // CHECK NEXT ASSIGNEE IF EXITST WHEN CLICK MODAL BUTTON
              // $("#autoassignmodalbtn").click(function(e){
              //   var autoassinee = $("#autoassignsrchrslt tr td:eq(5)").text();
              //   if(autoassinee == ''){
              //     $("#autoassigntitle").text(' Set Next Assignee');
              //     $("#autoassinexistmsg").text('');
              //   }else{
              //     $("#autoassigntitle").text('Edit Next Assignee');
              //     $("#autoassinexistmsg").text('Next assignee already asigned for this issue,you can edit.');
              //   }
              // })



            $('#filter').click(function(e){
              e.preventDefault();


                // $("#autoassigntitle").text(' Set Next Assignee');
                // $("#autoassinexistmsg").text('');

                var project = $('#project').val();
                var app = $('#app').val();
                var assignee = $('#assignee').val();

                if(project != '' &&  project != '' && assignee != '' )
                {

                    $('#autoassignsrchrslt').DataTable().destroy();
                    fill_datatable(project, app, assignee);
                }
                else
                {
                    alert('Select Both filter option');
                }

                $("#newassignee").empty();
                $("#newstatus").empty();

                $("#newassignissueid").val('');
                $("#newassignee").val('');
                $("#newstatus").val('');
                $("#autoassignmsg").val('');

                // $('#appholder').text('');
                $('#issueholer').text('');
                $('#typeholder').text('');
                $('#projectholder').text('');
                $('#catholder').text('');
                $('#nextissueholder').text('');
                $('#nextuser').text('');

                //generate drop down after clicking filter and project id taking form serch project selection from dropdwon
                selectedissueprojectassignee({{ $id ?? '' }});
                selectedissueprojectstatus({{ $id ?? '' }});


            });

            $('#reset').click(function(){
                $('#project').val('');
                $('#app').val('');
                $('#assignee').val('');
                $('#autoassignsrchrslt').DataTable().destroy();
                fill_datatable();

                $("#newassignee").empty();
                $("#newstatus").empty();

                $("#newassignissueid").val('');
                $("#newassignee").val('');
                $("#newstatus").val('');
                $("#autoassignmsg").val('');

                // $('#appholder').text('');
                $('#issueholer').text('');
                $('#typeholder').text('');
                $('#projectholder').text('');
                $('#catholder').text('');
                $('#nextissueholder').text('');
                $('#nextuser').text('');

                selectedissueprojectassignee({{ $id ?? '' }});
                selectedissueprojectstatus({{ $id ?? '' }});

            });


            // select one issue
            $('#autoassignsrchrslt tbody').on( 'click', 'tr', function () {
              var table = $('#autoassignsrchrslt').DataTable();
               if ( $(this).hasClass('selected') ) {

                  $(this).removeClass('selected');

               } else {
                   table.$('tr.selected').removeClass('selected');
                   $(this).addClass('selected');
                   
                   var selecteedrowdata = $('#autoassignsrchrslt').DataTable().row('.selected').data();

                   var issueid = selecteedrowdata.id;
                   var projectidnew = selecteedrowdata.project_id;
                   //var appname = selecteedrowdata.app_name;
                   var projectname = selecteedrowdata.project_name;
                   var issuetitle = selecteedrowdata.issue_title;
                   var issuetype = selecteedrowdata.issue_type;
                   var catname = selecteedrowdata.category_name;
                   var issuestatus = selecteedrowdata.status_name;
                   var nextkickstatusname = selecteedrowdata.nextkickstatusname;
                   var nextissueassignee = selecteedrowdata.nextissueassignee;
                   var nextkcikstatusid = selecteedrowdata.nextkcikstatusid;
                   var nextissueassigneeid = selecteedrowdata.nextissueassigneeid;
                   var nextissuetitle = selecteedrowdata.nxtissuetitles;

                    // if(nextkcikstatusid == null && nextissueassigneeid == null){
                    //   $("#autoassigntitle").text(' Set Next Assignee');
                    //   $("#autoassinexistmsg").text('');
                    // } 
                    // else{
                    //   $("#autoassigntitle").text('Edit Next Assignee');
                    //   $("#autoassinexistmsg").text('Next assignee already asigned for this issue,you can edit.');
                    // }

                   //showing in selected table
                   //$('#appholder').text(appname);
                   $('#issueholer').text(issuetitle);
                   //$('#typeholder').text(issuetype);
                   $('#projectholder').text(projectname);
                   $('#catholder').text(catname);
                   $('#nextissueholder').text(nextissuetitle);
                   $('#nextuser').text(nextissueassignee);

                   //set issue and project id at hidden field to process new assign insertion
                   $('#newassignissueid').val(issueid);
                   $('#newprojectid').val(projectidnew);
                    
                    $("#newassignmsg").hide();

                    //show after clicking on table row
                    selectedissueprojectassignee({{ $id ?? '' }},issueid,nextissueassigneeid,nextkcikstatusid);
                    selectedissueprojectstatus({{ $id ?? '' }});
                    
                  
               }
           });


          //user show initially
          selectedissueprojectassignee({{ $id ?? '' }});
          selectedissueprojectstatus({{ $id ?? '' }});

// ############### generate assinee for auto assin portion ############
          function selectedissueprojectassignee(projectidnew,issueid,issuestatus,nextissueassigneeid,nextkcikstatusid){

                      $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                      });

                      $.ajax({
                          url : '{{ url('/getprojectnewassignee') }}',
                          method: 'POST',
                          data: {
                            "projectidnew": projectidnew
                          },
                          success: function (data) {

                            $("#newassignee").empty();
                            $("#newassignee").append('<option value=""> Select Next Assignee </option>');

                                if(data)
                                {
                                  $.each(data,function(key,value){
                                      $('#newassignee').append($("<option />", {
                                         value: key,
                                         text: value
                                      }));
                                  });


                                // <?php
                                //   //if(isset($dtbissue->next_user_id) && $dtbissue->next_user_id !== null ){?>

                                //     $element = $('#newassignee');
                                //     $options = $element.find('option');
                                //     $wanted_element = $options.filter(function () {
                                //       //return $(this).val() == 22 || $(this).text() == 22
                                //     });
                                //     $wanted_element.prop('selected', true);

                                // <?php// }else{ ?>
                                  
                                // <?php// } ?>

                              }

                          },
                            error: function (XMLHttpRequest, textStatus, errorThrown) {
                              alert('something went wrong');
                            }
                        });


                    }
// ############### generate assinee for auto assin portion ends ############  


// ############### generate new status for auto assin portion ############

          function selectedissueprojectstatus(projectidnew){

                      $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                      });

                      $.ajax({
                          url : '{{ url('/getprojectnewstatus') }}',
                          method: 'POST',
                          data: {
                            "projectidnew": projectidnew
                          },
                          success: function (data) {

                            $("#newstatus").empty();
                            $("#newstatus").append('<option value=""> Select Kick Status </option>');

                                if(data)
                                {
                                  $.each(data,function(key,value){
                                    // console.log(key);
                                      $('#newstatus').append($("<option/>", {
                                         value: key,
                                         text: value
                                      }));
                                  });


                                // to be dropdown selected with mathing the data
                                // <?php
                                //   //if(isset($dtbissue->next_kick_status) && !empty($dtbissue->next_kick_status)){?>
                                //     $element = $('#newstatus');
                                //     $options = $element.find('option');
                                //     $wanted_element = $options.filter(function () {
                                //       //return $(this).val() == <?php  ?> || $(this).text() == <?php  ?>
                                //     });
                                //     $wanted_element.prop('selected', true);
                                // <?php //}else{ ?>
                                // <?php //} ?>




                              }

                          },
                            error: function (XMLHttpRequest, textStatus, errorThrown) {
                              alert('something went wrong');
                            }
                        });
                    }
// ############### generate assinee for auto assin portion ends ############


          $("#btnassignnew").click(function(e){

                    e.preventDefault();
                    var mainissueids = $("#issueidforautoassign").val();
                    var newassignissueid = $("#newassignissueid").val();
                    var newassignee = $("#newassignee").val();
                    var newstatus = $("#newstatus").val();
                    var autoassignmsg = $("#autoassignmsg").val();

                    if (newassignissueid === "" || newassignissueid === null) {
                      $("#newassignmsg").show();
                      $("#newassignmsg").text('Select a issue first !');
                    }else if(newassignee === "" || newassignee === null){
                      $("#newassignmsg").show();
                      $("#newassignmsg").text('Select assignee please !');
                    }else if(newstatus === "" || newstatus === null){
                      $("#newassignmsg").show();
                      $("#newassignmsg").text('Select status please !');
                    }else{

                        $("#newassignmsg").hide();

                        $.ajaxSetup({
                          headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          }
                        });

                        $.ajax({
                          url : '{{ url('/newlyassignto') }}',
                          method: 'POST',
                          data: {
                            "newassignissueid": newassignissueid,
                            "mainissueid":mainissueids,
                            "newassignee": newassignee,
                            "newstatus": newstatus,
                            "autoassignmsg": autoassignmsg,
                          },
                            success: function (response) {
                              //console.log(response);
                              $('.nextuser').text(response.nextusername);
                              $('.nextstat').text(response.nextstatus);
                              $('.nextissue').text(response.nextissuetitle);
                              $('#next_user_id').val(response.nxtuseridofissue);
                              $('#next_kick_status').val(response.nxtstatsofissue);

                            $("#newassignmsgsuccess").show();
                            $("#newassignmsgsuccess").text('Auto assign Success !');
                            $('#newassignmsgsuccess').delay(2000).fadeOut();



                            $("#newassignee").empty();
                            $("#newstatus").empty();

                            $("#newassignissueid").val('');
                            $("#newassignee").val('');
                            $("#newstatus").val('');
                            $("#autoassignmsg").val('');

                            // $('#appholder').text('');
                            $('#issueholer').text('');
                            $('#typeholder').text('');
                            $('#projectholder').text('');
                            $('#catholder').text('');

                            // setTimeout(function(){
                            //    location.reload();
                            // }, 2000);
                            gantt.render();

                            setTimeout(function(){
                                $(function () {
                                   $('#myModal').modal('toggle');
                                });

                                $('#myModal').on('hidden.bs.modal', function () {
                                  $("#lightboxform").css("visibility", 'visible');
                                });
                            }, 1000);

                             $.iaoAlert({msg: "Auto assigning successful !",
                            type: "success",
                            mode: "dark",});



                            },
                            error: function (XMLHttpRequest, textStatus, errorThrown) {
                              alert('something went wrong');
                            }
                        });
                    }

          });



        });
// #####################  serch issue for auto assign functionality ends ########################




          

          function ImageUpload(images){
            var myresult = "";
            var dataimg = new FormData();
            var form = dataimg.append('file', images);

            $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
            $.ajax({
              url : '{{ url('/uploadissuefiles') }}',
              method: 'POST',
              async: false,
              cache : false,
              contentType : false,
              processData : false,
              data :  dataimg,
                success: function (response) {
                //alert(response);
                //console.log(response);
                myresult = response;
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                  alert('error in uploading file');
                }
            });
         
            return myresult;
        }
      


//BIND TOAST UI EDITOR CONTENT TO TEXTAREA WHEN SUBMIT BUTTON CLICKED

      //FOR SHOWING MARKDOWN CONTENT USING SHOWDOWN JS
      var issuedesccontent = $("#issuedescholder").val();
      var markedcontent = document.getElementById('content').innerHTML = marked(issuedesccontent);







</script>

<style>
/*#lightboxform {
    position: absolute;
    top: -2%;
    left: 296px;
    width: 60%;
    z-index: 3;
    display: none;
    background-color: #F5F5F5;
    border: 6px solid #718AA8;
    padding: 20px 20px 5px 20px;
    font-family: Tahoma;
    /* margin: 0 auto; */
  /*  font-size: 10pt;*/
/*}*/
#lightboxform {
    position: absolute;
    top: -4%;
    padding-top: 33px !important;
    left: -21px;
    width: 103%;
    z-index: 3;
    display: none;
    background-color: #19191954;
    /* border: 6px solid #718AA8; */
    padding: 2px 346px;
    font-family: Tahoma;
    /* margin: 0 auto; */
    font-size: 10pt;
    height: 131%;
}
#lightboxform input, select {
    height: 32px !important;
    font-size: 13px !IMPORTANT;
    font-weight: 500 !important;
    margin: !IMPORTANT;
}

  #lightboxform input[type="button"]{
    margin: 10px;
  }





  .form-radio
{
     -webkit-appearance: none;
     -moz-appearance: none;
     appearance: none;
     display: inline-block;
     position: relative;
     background-color: #f1f1f1;
     color: #666;
     top: 10px;
     height: 30px;
     width: 30px;
     border: 0;
     border-radius: 50px;
     cursor: pointer;     
     margin-right: 7px;
     outline: none;
}
.form-radio:checked::before
{
     position: absolute;
     font: 13px/1 'Open Sans', sans-serif;
     left: 11px;
     top: 7px;
     content: '\02143';
     transform: rotate(40deg);
}
.form-radio:hover
{
     background-color: #f7f7f7;
}
.form-radio:checked
{
     background-color: #f1f1f1;
}
label
{
     font: 15px/1.7 'Open Sans', sans-serif;
     color: #333;
     -webkit-font-smoothing: antialiased;
     -moz-osx-font-smoothing: grayscale;
     cursor: pointer;
}

.gantt_tree_icon.gantt_blank {
    width: 0px !important;
}

.gantt_task_line .gantt_task_content {
    text-align: center;
    font-weight: 500;
}
.gantt_grid_data .gantt_row.gantt_selected, .gantt_grid_data .gantt_row.odd.gantt_selected {
    background-color: #4e51551f;
    border-top-color: #4e51551f;
}
.gantt_task_row.gantt_selected {
    background-color: #4e51551f;
}
.gantt_task_row.gantt_selected .gantt_task_cell {
    border-right-color: #4e51551f;
}

.gantt_cal_light {
    height: 292px !important;
    }

    .lightboxclosebtn {
    border: 0;
    width: 34px;
    position: absolute;
    top: 27px;
    background: whit !important;
    right: 305px;
    content: 'dfdsfds';
    background: black;
    color: 5px 14px;
    color: white;
    z-index: 9999999 !important;
}
/*
.lightboxclosebtn {
    border: 0;
    /* width: 100px; */
   /* position: absolute;
    top: -11px;
    background: #4e5155;
    right: -46px;
    content: 'dfdsfds';
    padding: 5px 14px;
    color: white;
}*/
.droptdownarea {
    background: #38587d;
    padding: 10px 12px 1px;
    border-radius: 3px;
}
.pickedissuearea h6 {
    padding: 7px 8px;
    margin-bottom: 4px;
    color: seagreen;
    background: beige;
    border: 1px solid #00000024;
}
.newassineearea {
    background: #38587d;
    padding: 16px 14px 7px;
}

#closeautoassignbox {
    position: absolute;
    right: -36px;
    background: black;
    padding: 0px 12px;
    top: 15px;
    color: white;
}
button#filter {
    padding: 4px 15px;
    border-radius: 0;
}
button#reset {
    padding: 4px 12px;
    border-radius: 0;
    margin-left: 11px;
}



.desccontent img {
    width: 100%;
}

.desccontent {
    overflow: hidden;
    width: 100%;
    background: #fafafa !IMPORTANT;
    margin-bottom: 28px;
    padding: 11px;
    border-radius: 4px;
}
.commenttitle{
      width: 100%;
    border-bottom: 1px solid #80808057;
    float: left;
    margin-bottom: 8px;
    font-weight: 500 !important;
    padding: 3px 9px;
    background: transparent;
}
#autoassignsrchrslt{
    border: 1px solid #d9d9d9;
    background: #ccd3d10d;
}
div#autoassignsrchrslt_wrapper tr td {
    font-size: 12px;
}
table#autoassignsrchrslt tr.selected {
      background: #0b0b0b0a;
    border-left: 7px solid #38587d;
}
.pickedissuearea {
    border: 1px solid #8080803b;
}


/*.lightboxviwpart {
    background: white !important;
    padding: 38px 18px !important;
}
.lightboxeditpart {
    background: white !important;
    padding: 38px 18px !important;
}*/

.lightboxinner {
    background: #efefef;
/*    height: 777px;
    overflow: scroll;*/
    /* overflow: hidden; */
    margin: 0 auto;
    border: 3px solid #38587d;
    padding: 3px 11px;
}
/*.lightboxinner {

    background: #efefef;
    overflow: hidden;
    margin: 0 auto;
    border: 3px solid #38587d;
    padding: 3px 11px;
}*/

#results {
    width: 100%;
    max-height: 555px !important;
    overflow-y: scroll;
    overflow-x: hidden;
}

#results img {
width: 100%;
}
#results table {
    margin: 2px 0 14px;
    color: #555;
    width: auto;
    border-collapse: collapse;
    box-sizing: border-box;
}
#results table th {
   padding: 3px;
    border: 1px solid #72777b;
    border-top: 0;
    background-color: #7b8184;
    font-weight: 300;
    color: #fff;
    padding-top: 6px;
}
#results table td {
    border: 1px solid #9d9898;
    padding: 3px;
}

.commentssingle {
    padding: 8px 14px;
    background: #fafafa;
    margin-bottom: 6px;
    /* margin: 4px 4px; */
    margin-right: 4px;
    margin-bottom: 11px;
    margin-top: 0px;
    border-radius: 4px;
    margin-left: 3px;
}

.commenter {
    /* background: #718aa81f; */
    margin: 5px 4px;
    padding: 3px 4px;
    min-width: 100%;
    font-size: 12px;
    margin-left: 1px;
    float: left;
    /* font-weight: 600; */
    border-radius: 2px;
}
.commenter span {
    background: #babbbc91;
    padding: 0px 14px 2px 7px;
    margin-left: -4px;
    margin-top: -1px;
    color: black;
    float: left;
    /* border-radius: 0px 15px 0px 0px; */
}


.tui-editor .te-preview-style-vertical .te-preview {
    background: #ede0b1cf !important;
}

span.nextissuestats {
    padding: 2px 4px;
    font-size: 11px;
    border-radius: 2px;
    font-weight: 500;
}
input.updatebtn {
    margin-left: 151px !important;
    border-radius: 15px;
    border: 1px solid #38587d;
    color: #38587d;
}
input.updatebtn:hover {
    background: #718aa8;
    color: white;
}

input.delissuebtn {
    margin-left: -6px !important;
    border-radius: 15px;
    border: 1px solid #38587d;
    color: #38587d;
}
input.delissuebtn:hover {
    background: #718aa8;
    color: white;
}
</style>
@endsection

