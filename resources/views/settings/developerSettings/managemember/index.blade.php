@extends('master_main')
@section('mainContent')
<!--    <h4 class="font-weight-bold py-2 mb-4">
     <span class="text-muted font-weight-light">Dashboard /</span> Manage Members
    </h4> -->


    <div class="row mt-5">
      <div class="col-md-12">
        <div class="container px-0">
          <h4 class="font-weight-bold py-2 mb-0 px-2">
            <div class="row">
            <!-- <input type="text" value="{{$current_month}}"> -->

             <div class="col-lg-4">
              {{ Form::open(['class' => '', 'files' => true, 'url' => 'velocity_search/'.$current_month.'/p',
           'method' => 'GET', 'enctype' => 'multipart/form-data']) }}
              <button type="submit" class="btn btn-warning bgtransparent hovercustombg"><span class="glyphicon glyphicon-chevron-left"></span>Previous month</button>
               {{ Form::close()}}
            </div>

             <div class="col-lg-4 text-center">Monthly Velocity <span class="text-muted">({{ \Carbon\Carbon::parse($current_month)->format('M-Y') }})</span></div>

             <div class="col-lg-4">
              {{ Form::open(['class' => '', 'files' => true, 'url' => 'velocity_search/'.$current_month.'/n',
           'method' => 'GET', 'enctype' => 'multipart/form-data']) }}
              <button type="submit" class="btn btn-warning pull-right bgtransparent hovercustombg">Next month<span class="glyphicon glyphicon-chevron-right"></span></button>
               {{ Form::close()}}
            </div>
           </div>
          </h4>

    <div class="card-datatable ">
    <div id="tickets-list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
     <div class="row">
      <div class="col-sm-12 col-md-6">
      </div>
      <div class="col-sm-12 col-md-6">

      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-lg-12">
        <table id="perprojectvaltbl" class=" table table-striped table-bordered dtb_custom_tbl_common" style="overflow: hidden !important;">
          <thead>
           <tr>
            <th width="20%">Project Name</th>
            <th>Velocity Value(Last Month)</th>
            <th></th>
            <th>Velocity Value(Current Month)</th>
          </tr>
        </thead>
        <tbody style="overflow: hidden !important;">
          @if(isset($velocityResult))
          @foreach($velocityResult as $value)

          @if($value->previous_velocity == '' && $value->velocity == '' )

          @else
           <tr role="row" class="odd">
            <td class="">
              <div class="p-0 p-md-0">
                 {{$value->project_name}}
              </div>
            </td>
            <td class="">
              <div class="p-0 p-md-0">
              <strong>
                @if($value->previous_velocity == '')

                @else
                {{$value->previous_velocity}}
                @endif
                </strong>
              </div>
            </td>
            <td class="">
              <div class="p-0 p-md-0">
                @if((int)$value->previous_velocity < (int)$value->velocity)
                <!-- <span class="glyphicon glyphicon-arrow-up" style="font-size: 30px; color: red;"></span> -->
                    <span class="valocityupicon valocityindication"></span>

                @elseif((int)$value->previous_velocity > (int)$value->velocity)
                    <span class="valocitydownicon valocityindication"></span>

                @elseif((int)$value->previous_velocity == (int)$value->velocity)
                <!-- <span>&#8680;</span> -->
                <span class="glyphicon glyphicon-arrow-right" style="font-size: 30px; color: green;"></span>
                @else

                @endif



            </td>
            <td class="">
              <div class="p-0 p-md-0">

                @if($value->velocity == '')

                @else
                {{$value->velocity}}
                @endif
              </div>
            </td>
          </tr>
          @endif
          @endforeach
          @endif
        </tbody>
      </table>
    </div>
      </div>
    </div>


        <hr>
        <div class="mt-5">

        <div class="row px-0">
            <h4 class="font-weight-bold py-0 px-0 mb-0">
            Members Velocity
            </h4>
          <label class="custom-control custom-checkbox mt-0 ml-4 mb-0">
          <input type="checkbox" name="is_archived" value="1" class="custom-control-input" id="chckarchived" style="border-color: #000">
          <span class="custom-control-label" style="color: #000">Include archived members</span>
          </label>
          <label class="custom-control custom-checkbox mt-0 ml-0 mb-0">
          <a class="btn-primary btn-sm mt-1 dtb_custom_btn_default" id="chckarchivedbtn" href="#" style="padding: 4px 12px;">Search</a>
          </label>
        </div>

</div>


   <div class="card-datatable  pt-3">
    <div id="tickets-list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
     <div class="row">
      <div class="col-sm-12 col-md-6">
      </div>
      <div class="col-sm-12 col-md-6">

      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-lg-12">



{{-- MEMBER VALOCITY SHOW WITHOUT ARCHIVED --}}

        <table id="valocitywithtarchivedtbl" class=" table table-striped table-bordered dtb_custom_tbl_common" style="overflow: hidden !important;">
          <thead>
           <tr>
            <th width="40px" style="width: 30px !important"></th>
            <th width="30%" style="width: 180px !important">Name</th>
            <th width="40px" style="width: 30px !important">Team</th>
            <th>Velocity Value(Last Month)</th>
            <th></th>
            <th>Velocity Value(Current Month)</th>
          </tr>
        </thead>

        <tbody style="overflow: hidden !important;" class="valocitywithtarchived">

    <?php
    $developer_id = Session::get('developer_id');
    $Membersvelocity = DB::select(DB::raw("SELECT u.id, u.name,u.is_archived,tm.team_id,tm.user_id,t.icon_path,(SELECT SUM(estimate_hour1) FROM dtb_issues WHERE user_id = u.id AND is_closed = 1 AND (DATE_FORMAT(complete_date, '%Y%m') = '$previous_month')) as previous_velocity,(SELECT SUM(estimate_hour1) FROM dtb_issues WHERE user_id = u.id AND is_closed = 1 AND (DATE_FORMAT(complete_date, '%Y%m') = '$current_month')) as velocity
    FROM dtb_users u LEFT JOIN dtb_develop_team_users tm ON u.id = tm.user_id LEFT JOIN dtb_develop_teams t ON tm.team_id = t.id WHERE u.developer_id = $developer_id AND u.is_archived = 0 AND u.role NOT IN (3,4,5) group by u.id order by velocity  DESC

    "));
   // dd($Membersvelocity);
  if(isset($Membersvelocity)){
    foreach($Membersvelocity as $index =>$value){


      if(!empty($value->name)){


          ?>
        @if($value->previous_velocity == '' && $value->velocity == '' )
        @else
           <tr role="row" class="odd">
            <td class="">
                <div class="p-0 p-md-0"  style="text-align: center;">
                @if($index == 0)
                <img style="padding-left: -5px;" src="{{asset('images/gold.png')}}" alt="" width="45px">
                @endif
                 @if($index == 1)
                <img src="{{asset('images/silver.png')}}" alt="" width="45px">
                @endif
                 @if($index == 2)
                <img src="{{asset('images/bronze.png')}}" alt="" width="45px">
                @endif
                </div>
            </td>
            <td class="">
              <div class="p-0 p-md-0" width:50px>
                <a href="{{route('managemember.show', $value->id)}}" class="text-body"> {{$value->name}} </a>
              </div>
            </td>
            <td class="">
                <div class="p-0 p-md-0" width:50px>
                  <a href="{{route('managemember.show', $value->id)}}" class="text-body"><img src="//{{$value->icon_path}}" alt="" class="d-block ui-w-30" style="margin:0 auto">  </a>
                </div>
            </td>
            <td class="">
              <div class="p-0 p-md-0">
              <strong>

                @if($value->previous_velocity == '')

                @else
                {{$value->previous_velocity}}
                @endif
              </strong>
              </div>
            </td>
            <td class="">
              <div class="p-0 p-md-0">
                @if((int)$value->previous_velocity < (int)$value->velocity)
                <span class="valocityupicon valocityindication"></span>
                @elseif((int)$value->previous_velocity > (int)$value->velocity)
                 <span class="valocitydownicon valocityindication"></span>
                @elseif((int)$value->previous_velocity == (int)$value->velocity)
                <span class="glyphicon glyphicon-arrow-right" style="font-size: 30px; color: green;"></span>
                @else
                @endif
              </div>
            </td>
            <td class="">
              <div class="p-0 p-md-0">
                @if($value->velocity == '')

                @else
                {{$value->velocity}}
                @endif
              </div>
            </td>
          </tr>
          @endif
        <?php
        }
      }
      }
      ?>

        </tbody>
 </table>


{{-- MEMBER VALOCITY SHOW WITH ARCHIVED --}}

        <table id="valocitywitharchivedtbl" class=" table table-striped table-bordered dtb_custom_tbl_common" style="overflow: hidden !important;">
          <thead>
           <tr>
            <th width="40px" style="width: 30px !important"></th>
            <th width="20%"  style="width: 180px !important">Name</th>
            <th width="40px" style="width: 30px !important">Team</th>
            <th>Velocity Value(Last Month)</th>
            <th></th>
            <th>Velocity Value(Current Month)</th>
          </tr>
        </thead>


        <tbody style="overflow: hidden !important;" class="valocitywitharchived">

    <?php
    $developer_id2 = Session::get('developer_id');
    $Membersvelocity2 = DB::select(DB::raw("SELECT u.id, u.name,u.is_archived,tm.team_id,tm.user_id,t.icon_path, (SELECT SUM(estimate_hour1) FROM dtb_issues WHERE user_id = u.id AND is_closed = 1 AND (DATE_FORMAT(complete_date, '%Y%m') = '$previous_month')) as previous_velocity, (SELECT SUM(estimate_hour1) FROM dtb_issues WHERE user_id = u.id AND is_closed = 1 AND (DATE_FORMAT(complete_date, '%Y%m') = '$current_month')) as velocity
    FROM dtb_users u LEFT JOIN dtb_develop_team_users tm ON u.id = tm.user_id LEFT JOIN dtb_develop_teams t ON tm.team_id = t.id WHERE u.developer_id = $developer_id2 AND u.role NOT IN (3,4,5) group by u.id order by velocity DESC
    "));
  if(isset($Membersvelocity2)){
    foreach($Membersvelocity2 as $index=>$value2){
      if(!empty($value2->name)){
          ?>

        @if($value2->previous_velocity == '' && $value2->velocity == '' )

        @else
           <tr role="row" class="odd">
             <td class="">
                <div class="p-0 p-md-0"  style="text-align: center;">
                @if($index == 0)
                <img style="padding-left: -5px;" src="{{asset('images/gold.png')}}" alt="" width="45px">
                @endif
                 @if($index == 1)
                <img src="{{asset('images/silver.png')}}" alt="" width="45px">
                @endif
                 @if($index == 2)
                <img src="{{asset('images/bronze.png')}}" alt="" width="45px">
                @endif
                </div>
            </td>
            <td class="">
              <div class="p-0 p-md-0">

                 <a href="{{route('managemember.show', $value2->id)}}" class="text-body"> {{$value2->name}} </a>
                 <span style="color: gray;font-size: 12px">@if ($value2->is_archived == 1) (Archived)  @endif</span>
              </div>
            </td>
            <td class="">
                <div class="p-0 p-md-0" width:50px>
                  <a href="{{route('managemember.show', $value2->id)}}" class="text-body"><img src="//{{$value2->icon_path}}" alt="" class="d-block ui-w-30" style="margin:0 auto">  </a>
                </div>
            </td>
            <td class="">
              <div class="p-0 p-md-0">
              <strong>
                @if($value2->previous_velocity == '')

                @else
                {{$value2->previous_velocity}}
                @endif
              </strong>
              </div>
            </td>
            <td class="">
              <div class="p-0 p-md-0">
                @if((int)$value2->previous_velocity < (int)$value2->velocity)
                <span class="valocityupicon valocityindication"></span>
                @elseif((int)$value2->previous_velocity > (int)$value2->velocity)
                 <span class="valocitydownicon valocityindication"></span>
                @elseif((int)$value2->previous_velocity == (int)$value2->velocity)
                <span class="glyphicon glyphicon-arrow-right" style="font-size: 30px; color: green;"></span>
                @else
                @endif
              </div>
            </td>
            <td class="">
              <div class="p-0 p-md-0">
                @if($value2->velocity == '')

                @else
                {{$value2->velocity}}
                @endif
              </div>
            </td>
          </tr>
          @endif
        <?php
        }
      }
      }
      ?>

        </tbody>

      </table>
    </div>
  </div>

</div>
</div>
</div>
</div>







    <div class="row mt-0">
          <div class="col-md-1"></div>
          <div class="col-md-12">
            <!-- Popular products -->
            <div class="card mb-4 no_border">
              <h6 class="card-header" style="background: #38587d;color: #fff;">
                <span style="float: left;font-weight:bold;font-size: 16px;margin-top: 6pxpx;">Members List</span>
                <a href="{{route('userreportmanage')}}" class="btn btn-success mngreport" style="">Manage Report</a>
            </h6>


        <div class="table-responsive px-4"><br>
            <div id="valocperuserarch">

{{-- TABLE ARCHIVED --}}
                    <table id="tblarchived" class="table card-table table table-striped table-bordered  dtb_custom_tbl_common tblarchived">
                        <thead>
                            <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                                <?php
                                for ($i = 12; $i >= 0; $i--) { ?>
                                    <th> <?php  echo $months[] = date("Y-m", strtotime( date( 'Y-m-01' )." -$i months")); ?></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                    </tr>
                    <?php
                        $loggedindeveloper = Session::get('developer_id');
                        if ($loggedindeveloper !== "" ) {
                        $totaldevs = DB::table('dtb_users')->select('id')->where('developer_id', $loggedindeveloper)->count();
                        $memberlists = DB::table('dtb_users')
                        ->select('id','ud_id','email','name','icon_image_path','is_archived')
                        ->where('developer_id', $loggedindeveloper)
                        ->whereNotIn('role', [3,4,5])->get();
                        // $projectofdeveloper = \App\DtbProject::where('developer_id', '=', $loggedindeveloper)->get()->toArray();
                        }
                    ?>

                    @foreach($memberlists as $uservaloc)
                        <?php
                            $valocperuser = DB::select(DB::raw("
                                SELECT DATE_FORMAT(i.complete_date, '%Y-%m') as month,i.project_id,i.user_id , u.name ,u.icon_image_path, SUM(estimate_hour1) as velocity FROM dtb_issues i LEFT JOIN dtb_users u ON i.user_id = u.id WHERE i.is_closed = 1 and i.user_id = $uservaloc->id  group by month order by month DESC"
                            ));
                        ?>

                        <tr>
                            <th class="titletd" width="60px">{{ $uservaloc->id ?? '' }} </th>
                            <th class="titletd" width="190px">
                            <a style="float: left;margin-top: px;" href="{{route('managemember.show', $uservaloc->id)}}" class="text-body">
                                <span style="float: left;margin-right: 14px">
                                    @if(!empty($uservaloc->icon_image_path))
                                    @php $image_path2 = url($uservaloc->icon_image_path); @endphp
                                    <img src="//{{ $uservaloc->icon_image_path }}" alt="" class="d-block ui-w-30 rounded-circle" style="margin:0 auto">
                                    @else
                                    <img src="{{asset('assets_/img/user_avatar.png')}}" alt="" class="d-block ui-w-30 rounded-circle" style="margin:0 auto">
                                    @endif
                                </span>

                                {{ $uservaloc->name ?? '' }} <span style="color: gray;font-size: 12px">@if ($uservaloc->is_archived == 1) (Archived)  @endif</span>
                            </a>
                            </th>
                            <th class="titletd" width="190px">{{ $uservaloc->email ?? '' }}</th>
                            <?php if (isset($valocperuser)) {
                                for ($i = 12; $i >= 0; $i--)
                                {
                                    $monthgenerated = date("Y-m", strtotime( date( 'Y-m-01' )." -$i months")); ?>
                                    <?php $j=0; ?>
                                    @foreach ($valocperuser as $valocusr)
                                        @if($monthgenerated == $valocusr->month)
                                        <?php $j++; ?>
                                        <th>{{ $valocusr->velocity ?? '' }}</th>
                                        @endif
                                    @endforeach
                                    <?php if( $j ==0){ ?>
                                    <th>0</th>
                                    <?php  }
                                }
                            } ?>
                        </tr>

                    @endforeach
                        </tbody>
                        </table>
            </div>



{{-- TABLE NOT ARCHIVED --}}
            <div id="valocperusernotarch">
                <table id="tblnotarchived" class="table card-table table table-striped table-bordered  dtb_custom_tbl_common tblnotarchived">
                    <thead>
                        <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                            <?php
                            for ($i = 12; $i >= 0; $i--) { ?>
                                <th> <?php  echo $months[] = date("Y-m", strtotime( date( 'Y-m-01' )." -$i months")); ?></th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                     <tr>
                </tr>
                <?php
                    $loggedindeveloper = Session::get('developer_id');
                    if ($loggedindeveloper !== "" ) {
                    $totaldevs = DB::table('dtb_users')->select('id')->where('developer_id', $loggedindeveloper)->count();
                    $memberlists = DB::table('dtb_users')
                    ->select('id','ud_id','email','name','icon_image_path','is_archived')
                    ->where('is_archived', 0)
                    ->where('developer_id', $loggedindeveloper)
                    ->whereNotIn('role', [3,4,5])->get();
                    // $projectofdeveloper = \App\DtbProject::where('developer_id', '=', $loggedindeveloper)->get()->toArray();
                    }
                ?>

                @foreach($memberlists as $uservaloc)
                      <?php
                           $valocperuser = DB::select(DB::raw("
                              SELECT DATE_FORMAT(i.complete_date, '%Y-%m') as month,i.project_id,i.user_id , u.name ,u.icon_image_path, SUM(estimate_hour1) as velocity FROM dtb_issues i LEFT JOIN dtb_users u ON i.user_id = u.id WHERE i.is_closed = 1 and i.user_id = $uservaloc->id  group by month order by month DESC"
                        ));
                      ?>

                      <tr>
                        <th class="titletd" width="60px">{{ $uservaloc->id ?? '' }} </th>
                        <th class="titletd" width="190px">
                        <a style="float: left;margin-top: px;" href="{{route('managemember.show', $uservaloc->id)}}" class="text-body">
                            <span style="float: left;margin-right: 14px">
                                @if(!empty($uservaloc->icon_image_path))
                                @php $image_path2 = url($uservaloc->icon_image_path); @endphp
                                <img src="//{{ $uservaloc->icon_image_path }}" alt="" class="d-block ui-w-30 rounded-circle" style="margin:0 auto">
                                @else
                                <img src="{{asset('assets_/img/user_avatar.png')}}" alt="" class="d-block ui-w-30 rounded-circle" style="margin:0 auto">
                                @endif
                            </span>

                            {{ $uservaloc->name ?? '' }}
                        </a>
                        </th>
                        <th class="titletd" width="190px">{{ $uservaloc->email ?? '' }}</th>
                          <?php if (isset($valocperuser)) {
                              for ($i = 12; $i >= 0; $i--)
                              {
                                $monthgenerated = date("Y-m", strtotime( date( 'Y-m-01' )." -$i months")); ?>
                                <?php $j=0; ?>
                                @foreach ($valocperuser as $valocusr)
                                      @if($monthgenerated == $valocusr->month)
                                      <?php $j++; ?>
                                       <th>{{ $valocusr->velocity ?? '' }}</th>
                                      @endif
                                @endforeach
                                <?php if( $j ==0){ ?>
                                  <th>0</th>
                                <?php  }
                              }
                        } ?>
                    </tr>

                @endforeach
                    </tbody>
                </table>

            </div>

                <br>
              </div>

            </div>
            <!-- / Popular products -->
          </div>

          <div class="col-md-1"></div>
    </div>








<style>
.mngreport {
    background: transparent;float: right;border: 1px solid;padding: 5px 31px;
}

.totaldevs {
display: block;

background-image: url("assets_/img/memmbericonwhite.png");;
width: 58px;
height: 46px;
margin-right: 3px;
background-repeat: no-repeat;
margin-top: 13px;
background-size: 53px;
}
.reportmanagebtn{
  width: 100%;
    background: #38587D;
}
.custom-checkbox .custom-control-label::before {
    background-size: 65%;
    border-color: #000;
}


div#tblarchived_wrapper {
    display: none;
}

/*div#tblnotarchived_wrapper {
    display: none;
}*/


.datatables-demo, th, td {
    text-align: center;
    vertical-align: middle;
}
.valocityupicon{
    background-image: url('{{ URL::asset('assets_/img/valocityUpIcon.png')}}');
}

.valocitydownicon{
    background-image: url('{{ URL::asset('assets_/img/valocityDownIcon.png')}}');
}

.valocitydrighticon{
    background-image: url('{{ URL::asset('assets_/img/valocityDownIcon.png')}}');
}
  .valocityindication{
          padding: 18px;
      display: block;
      background-repeat: no-repeat;
      width: 28px;
      text-align: center;
      margin: 0 auto;
      background-position: center;
          background-size: 55%;
  }

  div#valocitywitharchivedtbl_wrapper {
    display: none;
}
</style>


<script>





$(document).ready(function() {

// PER USER MONTHLY VALOCITY
    $("#valocperuserarch").hide();
    $("#valocperusernotarch").show();


//initially not archived table will show and archived table will hide
    //    $('#tblnotarchived').dataTable({
    //       // "bLengthChange": false,
    //       // "paginate": false,
    //       // "order":[]
    //      });

    //    $("div#tblarchived_wrapper").css({"display": "none"});

    //    $('#tblarchived').dataTable({
    //       // "bLengthChange": false,
    //       // "paginate": false,
    //       // "searching": false,
    //       // "bInfo": false,
    //       // "order":[]
    //     });

       $(".witharchivecount").hide();
       $(".withoutarchivecount").show();



        $("#valocitywitharchivedtbl").hide();
        $("div#valocitywitharchivedtbl_wrapper").css({"display": "none"});

        $("#valocitywithtarchivedtbl").show();
        $("div#valocitywithtarchivedtbl_wrapper").css({"display": "none"});

//after clicking search button this code will execute
        $('#chckarchivedbtn').click(function(e){
            e.preventDefault();

            if($("#chckarchived").is(":not(:checked)")){
              alert('check the box first!');
            }

            if($("#chckarchived").is(":checked")){


            //  $("#tblnotarchived").hide();
            //  $("div#tblnotarchived_wrapper").css({"display": "none"});
            //  $("#tblarchived").show();
            //  $("div#tblarchived_wrapper").css({"display": "block"});

             $(".witharchivecount").show();
             $(".withoutarchivecount").hide();


            $("#valocitywitharchivedtbl").show();
            $("div#valocitywitharchivedtbl_wrapper").css({"display": "block"});

            $("#valocitywithtarchivedtbl").hide();
            $("div#valocitywithtarchivedtbl_wrapper").css({"display": "none"});


// PER USER MONTHLY VALOCITY
            $("#valocperuserarch").show();
            $("#valocperusernotarch").hide();


          }else if($("#chckarchived").is(":not(:checked)")){

            // $("#tblnotarchived").show();
            // $("div#tblnotarchived_wrapper").css({"display": "block"});

            // $("#tblarchived").hide();
            // $("div#tblarchived_wrapper").css({"display": "none"});

            $(".witharchivecount").hide();
            $(".withoutarchivecount").show();


            $("#valocitywitharchivedtbl").hide();
            $("div#valocitywitharchivedtbl_wrapper").css({"display": "none"});

            $("#valocitywithtarchivedtbl").show();
            $("div#valocitywithtarchivedtbl_wrapper").css({"display": "none"});

// PER USER MONTHLY VALOCITY
            $("#valocperuserarch").hide();
            $("#valocperusernotarch").show();



          }

        });



//uncheck after check ,this will be triggered
        $('#chckarchived').change(function() {
          if($("#chckarchived").is(":not(:checked)")){
            // $("#tblnotarchived").show();
            // $("div#tblnotarchived_wrapper").css({"display": "block"});
            // $("#tblarchived").hide();
            // $("div#tblarchived_wrapper").css({"display": "none"});

            $(".witharchivecount").hide();
            $(".withoutarchivecount").show();

        $("#valocitywitharchivedtbl").hide();
        $("#valocitywitharchivedtbl_wrapper").css({"display": "none"});

        $("#valocitywithtarchivedtbl").show();
        $("#valocitywithtarchivedtbl_wrapper").css({"display": "block"});


// PER USER MONTHLY VALOCITY
            $("#valocperuserarch").hide();
            $("#valocperusernotarch").show();


          }
        });



 });









$(document).ready(function() {
//    $('#tblarchived').dataTable({
//       "bLengthChange": false,
//       "paging": true,
//       "info": false,
//       "order":[]
//      });

//      $('#tblnotarchived').dataTable({
//       "bLengthChange": false,
//       "paging": true,
//       "info": false,
//       "order":[]
//      });




$('#valocitywithtarchivedtbl').dataTable({
      "bLengthChange": false,
      "paging": false,
      "info": false,
      "order":[]
    });
     $('#valocitywitharchivedtbl').dataTable({
      "bLengthChange": false,
      "paging": false,
      "info": false,
      "order":[]
     });

     $('#perprojectvaltbl').dataTable({
      "bLengthChange": false,
      "paging": false,
      "info": false,
      "order":[]
     });





 });
</script>

@endsection
