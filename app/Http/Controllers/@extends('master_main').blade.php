@extends('master_main')
@section('mainContent')
<!--    <h4 class="font-weight-bold py-2 mb-4">
     <span class="text-muted font-weight-light">Dashboard /</span> Manage Members
    </h4> -->


    <div class="row">
      <div class="col-md-12">
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
          @endforeach
          @endif
        </tbody>
      </table>
    </div>
      </div>
    </div>







<div class="mt-5">

        <div class="row px-3">
            <h4 class="font-weight-bold py-0 px-4 mb-0">
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
<div class="">

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

        <table id="valocitywithtarchivedtbl" class="datatables-demo table table-striped table-bordered dtb_custom_tbl_common" style="overflow: hidden !important;">
          <thead>
           <tr>
            <th width="20%">Name</th>
            <th>Velocity Value(Last Month)</th>
            <th></th>
            <th>Velocity Value(Current Month)</th>
          </tr>
        </thead>

        <tbody style="overflow: hidden !important;" class="valocitywithtarchived">

    <?php 
    $developer_id = Session::get('developer_id');
    $Membersvelocity = DB::select(DB::raw("SELECT u.id, u.name,u.is_archived,(SELECT SUM(estimate_hour1) FROM dtb_issues WHERE user_id = u.id AND is_closed = 1 AND (DATE_FORMAT(complete_date, '%Y%m') = '$previous_month')) as previous_velocity,
    (SELECT SUM(estimate_hour1) FROM dtb_issues WHERE user_id = u.id AND is_closed = 1 AND (DATE_FORMAT(complete_date, '%Y%m') = '$current_month')) as velocity
    FROM dtb_users u 
    WHERE u.developer_id = $developer_id AND u.is_archived = 0 order by velocity DESC
    "));
  if(isset($Membersvelocity)){
    foreach($Membersvelocity as $value){
      if(!empty($value->name)){
          ?>
           <tr role="row" class="odd">
            <td class="">
              <div class="p-0 p-md-0"> 
                 {{$value->name}} 
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
        <?php 
        } 
      }
      }
      ?>
          
        </tbody>
 </table>


{{-- MEMBER VALOCITY SHOW WITH ARCHIVED --}}

        <table id="valocitywitharchivedtbl" class="datatables-demo table table-striped table-bordered dtb_custom_tbl_common" style="overflow: hidden !important;">
          <thead>
           <tr>
            <th width="20%">Name</th>
            <th>Velocity Value(Last Month)</th>
            <th></th>
            <th>Velocity Value(Current Month)</th>
          </tr>
        </thead>


        <tbody style="overflow: hidden !important;" class="valocitywitharchived">

    <?php 
    $developer_id2 = Session::get('developer_id');
    $Membersvelocity2 = DB::select(DB::raw("SELECT u.id, u.name,u.is_archived,(SELECT SUM(estimate_hour1) FROM dtb_issues WHERE user_id = u.id AND is_closed = 1 AND (DATE_FORMAT(complete_date, '%Y%m') = '$previous_month')) as previous_velocity,
    (SELECT SUM(estimate_hour1) FROM dtb_issues WHERE user_id = u.id AND is_closed = 1 AND (DATE_FORMAT(complete_date, '%Y%m') = '$current_month')) as velocity
    FROM dtb_users u 
    WHERE u.developer_id = $developer_id2  order by velocity DESC
    "));
  if(isset($Membersvelocity2)){
    foreach($Membersvelocity2 as $value2){
      if(!empty($value2->name)){
          ?>
           <tr role="row" class="odd">
            <td class="">
              <div class="p-0 p-md-0"> 
                 {{$value2->name}} 
                 <a href="{{route('managemember.show', $value2->id)}}" class="text-body">{{ $value2->id ?? "" }}</a>
                 <span style="color: gray;font-size: 12px">@if ($value2->is_archived == 1) (Archived)  @endif</span>
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







    <div class="row mt-4">
          <div class="col-md-1"></div>
          <div class="col-md-12">
            <!-- Popular products -->
            <div class="card mb-4 no_border">
              <h6 class="card-header" style="background: #38587d;color: #fff;">Members List</h6>






              <div class="table-responsive px-4"><br> 

{{-- TABLE ARCHIVED --}}
            <table id="tblarchived" class="table card-table table table-striped table-bordered  dtb_custom_tbl_common tblarchived">
                  <thead>
                    <tr>
                      <th style="width:10px !important">ID</th>
                      <th width="250px">Name</th>
                      <th width="250px">Email</th>
                    </tr>
                  </thead>
                  <tbody>
archived
                    <tr>
                        <td style="widtd:10px !important">ID</td>
                        <td widtd="250px">Name</td>
                        <td widtd="250px">Email</td>
                      </tr>
                  </tbody>
                </table>




{{-- TABLE NOT ARCHIVED --}}

                <table id="tblnotarchived" class="table card-table table table-striped table-bordered  dtb_custom_tbl_common tblnotarchived">
                  <thead>
                    <tr>
                      <th style="width:10px !important">ID</th>
                      <th width="250px">Name</th>
                      <th width="250px">Email</th>
                    </tr>
                  </thead>
                  <tbody>
            not archived
            <tr>
                <td style="widtd:10px !important">ID</td>
                <td widtd="250px">Name</td>
                <td widtd="250px">Email</td>
              </tr>
                  </tbody>
                </table>
                <br>
              </div>

            </div>
            <!-- / Popular products -->
          </div>

          <div class="col-md-1"></div>
    </div>



        <div class="row">
            <div class="col-md-12">
                  <!-- Sale stats -->
                <div class="card mb-0">
                    <div class="table-responsive">
                        <table class="table card-table table-bordered table-striped dtb_custom_tbl_common" id="workingdaytbl">

                        </table>
                    </div>
                </div>
            </div>
        </div>




<style>
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
</style>


<script>
  




$(document).ready(function() {


//initially not archived table will show and archived table will hide
       $('#tblnotarchived').dataTable({
          // "bLengthChange": false,
          // "paginate": false,
          // "order":[]
         });
       $("#tblnotarchived").show();
       $("div#tblarchived_wrapper").css({"display": "none"});

       $("#tblarchived").hide();
       $('#tblarchived').dataTable({
          // "bLengthChange": false,
          // "paginate": false,
          // "searching": false,
          // "bInfo": false,
          // "order":[]
        });

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


             $("#tblnotarchived").hide();
             $("div#tblnotarchived_wrapper").css({"display": "none"});
             $("#tblarchived").show();
             $("div#tblarchived_wrapper").css({"display": "block"});

             $(".witharchivecount").show();
             $(".withoutarchivecount").hide();


            $("#valocitywitharchivedtbl").show();
            $("div#valocitywitharchivedtbl_wrapper").css({"display": "block"});

            $("#valocitywithtarchivedtbl").hide();
            $("div#valocitywithtarchivedtbl_wrapper").css({"display": "none"});

          }else if($("#chckarchived").is(":not(:checked)")){

            $("#tblnotarchived").show();
            $("div#tblnotarchived_wrapper").css({"display": "block"});
            $("#tblarchived").hide();
            $("div#tblarchived_wrapper").css({"display": "none"});

            $(".witharchivecount").hide();
            $(".withoutarchivecount").show();


            $("#valocitywitharchivedtbl").hide();
            $("div#valocitywitharchivedtbl_wrapper").css({"display": "none"});

            $("#valocitywithtarchivedtbl").show();
            $("div#valocitywithtarchivedtbl_wrapper").css({"display": "none"});

  
          }

        });



//uncheck after check ,this will be triggered
        $('#chckarchived').change(function() {
          if($("#chckarchived").is(":not(:checked)")){
            $("#tblnotarchived").show();
            $("div#tblnotarchived_wrapper").css({"display": "block"});
            $("#tblarchived").hide();
            $("div#tblarchived_wrapper").css({"display": "none"});

            $(".witharchivecount").hide();
            $(".withoutarchivecount").show();

        $("#valocitywitharchivedtbl").hide();
        $("#valocitywitharchivedtbl_wrapper").css({"display": "none"});
        
        $("#valocitywithtarchivedtbl").show();
        $("#valocitywithtarchivedtbl_wrapper").css({"display": "block"});


          }  
        });



 });









$(document).ready(function() {
   $('#valocitywitharchivedtbl').dataTable({
      "bLengthChange": false,
      "paging": true,
      "info": false,
      "order":[]
     });

    $('#valocitywithtarchivedtbl').dataTable({
      "bLengthChange": false,
      "paging": true,
      "info": false,
      "order":[]
    });

 });
</script>

@endsection