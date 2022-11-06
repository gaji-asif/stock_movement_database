@extends('master_main')
@section('mainContent')
<style type="text/css">
  .project_details:hover{
      background-color: #FFD950;
  }
  .datatables-demo, th, td
{
    text-align: center;
    vertical-align: middle;
}
</style>

<div class="container mt-4">
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
<div class="container px-0">
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
        <table class="datatables-demo table table-striped table-bordered dtb_custom_tbl_common" style="overflow: hidden !important;">
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
          @endforeach
          @endif
        </tbody>
      </table>
    </div>
  </div>

</div>
</div>
</div>

<div class="mt-5">
    <h4 class="font-weight-bold py-0 px-4 mb-0">
   Members Velocity
 </h4>
</div>
<div class="container px-0 mt-0">

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
        <table class="datatables-demo table table-striped table-bordered dtb_custom_tbl_common" style="overflow: hidden !important;">
          <thead>
           <tr>
            <th width="40px" style="width: 30px !important"></th>
            <th width="20%">Name</th>
            <th width="40px" style="width: 40px">Team</th>
            <th>Velocity Value(Last Month)</th>
            <th></th>
            <th>Velocity Value(Current Month)</th>
          </tr>
        </thead>
        <tbody style="overflow: hidden !important;">
        <?php
  if(isset($Membersvelocity)){
    foreach($Membersvelocity as $index=>$value){
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
              <div class="p-0 p-md-0">
                <a style="margin-top: px;" href="{{route('managemember.show', $value->id)}}" class="text-body">
                 {{$value->name}}
                </a>
              </div>
            </td>
            <td class="p-1" style="text-align: center">
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
                <!-- <span class="glyphicon glyphicon-arrow-up" style="font-size: 30px; color: red;"></span> -->
                <span class="valocityupicon valocityindication"></span>
                @elseif((int)$value->previous_velocity > (int)$value->velocity)
                 <span class="valocitydownicon valocityindication"></span>
                <!-- <span class="glyphicon glyphicon-arrow-down" style="font-size: 30px; color: blue;"></span> -->
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
        <h6 class="card-header" style="background: #38587d;color: #fff;">Members List</h6>


  <div class="table-responsive px-4"><br>
      <div id="valocperuserarch">

{{-- TABLE ARCHIVED --}}
              <table id="tblarchived" class="table card-table table table-striped table-bordered  dtb_custom_tbl_common tblarchived">
                  <thead>
                      <tr>
                      <th></th>
                      <th></th>
                      <th></th>
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
                  <th></th>
                  <th></th>
                  <th></th>
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

</style>

<style>
div#DataTables_Table_0_wrapper .col-sm-12.col-md-6 {
    /* padding-left: 0px; */
    padding: 0px !important;
}
.default-style div.card-datatable [class*="col-md-"] {
    padding: 0px !important;
  }
  .dtb_custom_tbl_common tbody tr td {
    padding: 0px 7px 0px !important;
}
ul.pagination {
    display: none;
}
.totalprojecticon{background-image: url(http://localhost/developmentmanage/public/assets_/img/totalproject.png);}
</style>
<script type="text/javascript">
 $(document).ready(function() {
   $('.datatables-demo').dataTable({
      "bLengthChange": false,
      "bPaginate":false,
      "bInfo": false,
      "order":[],
     });




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
        $("#valocitywitharchivedtbl_wrapper").css({"display": "none"});
        $("#valocitywithtarchivedtbl").show();



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












</script>
@endsection
