@extends('master_main')
@section('mainContent')
<style type="text/css">
  .fa{
    font-size: 10px;
    text-align: right;
    float: right;
    padding-top: 7px;
    margin-right: 2px;
  }
  .arrow_sorting{
    cursor: pointer;
     color: cadetblue;
  }
</style>
<!-- <h4 class="font-weight-bold py-2 mb-4">
 All Issues
</h4> -->

<div class="px-0 pt-1 mt-4">
  <?php //echo Session::get('developertimezone');?>
  {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'seacrh_my_issue',
  'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
  <div class="form-row">
    <div class="col-md-2 mb-3">
     <label class="form-label">Project</label>
     <select class="custom-select NoborderRadius" name="selectProject" id="selectProject">
      <option value="">Select</option>
      @foreach($projects as $project)
      <option value="{{ $project->id }}" {{ old('selectProject',$formArry['selectProject'])==$project->id?'selected':'' }} >{{ $project->project_name }}</option>
      @endforeach
    </select>
  </div>
  <style>
    div.dataTables_wrapper .dataTables_filter input{
      margin-right: -11px;
    }
  </style>
  <div class="col-md-2 mb-3">
   <label class="form-label">Assignee</label>
   <select class="custom-select NoborderRadius" name="selectAssignee" id="selectAssignee">
    <option value="">Select</option>
    @foreach($assignees as $assignee)
    <option value="{{ $assignee->id }}" {{old('selectAssignee',$formArry['selectAssignee'])==$assignee->id?'selected':(!isset($formArry['selectAssignee'])&&Session::get('user_id')==$assignee->id?'selected':'') }}>{{ $assignee->name }}</option>
    @endforeach
  </select>
</div>


<div class="col-md-3 mt-3">
  <div class="dtb_custom_inline_chckbox_holder">
    <ul>
      <li>
        <label class="form-label custom-control custom-checkbox mt-3 ml-0">
          <input type="checkbox" name="is_complete" id="is_complete" value="1" class="custom-control-input dtb_custom_checkbox_input"  {{ isset($formArry['is_complete'])?'checked':''}}>
          <span class="custom-control-label dtb_custom_checkbox_lablel">Is complete status?</span>
        </label>
      </li>
    </ul>
  </div>
</div>

<div class="col-md-2 col-xl-2 mb-4">
 <label class="form-label d-none d-md-block">&nbsp;</label>
 <button type="submit" class="btn btn-success dtb_custom_btn_default">Search</button>
</div>

</div>
{{ Form::close() }}


</div>
<!-- / Filters -->
<!-- <div class="card"> -->
  <div class="">
   <div class="card-datatable table-responsive" style="padding-top: 0px">
    <div id="tickets-list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
      {{--    <div class="row">
        <div class="col-sm-12 col-md-6 "  style="padding-left: 0px !important;">
          <input type="hidden" value="1" id="tracker">
          <a data-modal-size="modal-lg" href="{{route('change_at_once_my_issues')}}" data-original-title="Change At Once" class="change_at_once_my_issues" ><button type="submit" class="btn-success dtb_primary_btn"  style="margin-right: 5px;">Change At Once</button></a>
          <button class="btn-default " id="select_all" style="margin-right: 5px;">Select All</button>
          <button class="btn-danger dtb_secondary_btn" id="clear_all">Clear All</button>
          <p id="demo"></p>
        </div>
        <div class="col-sm-12 col-md-6">

        </div>
      </div> --}}
      <div class="row mt-2">
        <div class="col-sm-12 col-lg-12">

          @if(session()->has('message'))
          <br>
          <div class="alert alert-success mb-10 background-success" role="alert">
            {{ session()->get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
          <table id="my_isssues_datatable" class="datatables-demo table table-striped table-bordered tbl_common dtb_custom_tbl_common" style="overflow: hidden !important;">
            <thead>
             <tr>
              <th width="6%">
                <i class="fa fa-arrow-down arrow_sorting" arrow_value="id_d"></i> 
                <i class="fa fa-arrow-up arrow_sorting" arrow_value="id_u"></i>
              #SL</th>
              <th>
                <i class="fa fa-arrow-down arrow_sorting" arrow_value="appid_d"></i> 
                <i class="fa fa-arrow-up arrow_sorting" arrow_value="appid_u"></i>
              App </th>
              <th>
                <i class="fa fa-arrow-down arrow_sorting" arrow_value="i_d"></i> 
                <i class="fa fa-arrow-up arrow_sorting" arrow_value="i_u"></i>
              Issue Title </th>
              <th width="8%">Project <i class="fa fa-arrow-down arrow_sorting" arrow_value="p_d"></i> <i class="fa fa-arrow-up arrow_sorting" arrow_value="p_u"></i></th>
              <th width="8%">
                <i class="fa fa-arrow-down arrow_sorting" arrow_value="c_d"></i> 
                <i class="fa fa-arrow-up arrow_sorting" arrow_value="c_u"></i>
              Category </th>
              <th width="9%">
                 <i class="fa fa-arrow-down arrow_sorting" arrow_value="userid_d"></i> 
                <i class="fa fa-arrow-up arrow_sorting" arrow_value="userid_u"></i>
              Assignee </th>
              <!--  <th>AssignedBy</th> -->
              <th>
                <i class="fa fa-arrow-down arrow_sorting" arrow_value="status_d"></i> 
                <i class="fa fa-arrow-up arrow_sorting" arrow_value="status_u"></i>
              Status </th>
              <th width="8%">
                <i class="fa fa-arrow-down arrow_sorting" arrow_value="progress_d"></i> 
                <i class="fa fa-arrow-up arrow_sorting" arrow_value="progress_u"></i>
              Progress </th>
              <th>
                <i class="fa fa-arrow-down arrow_sorting" arrow_value="issuepriorityid_d"></i> 
                <i class="fa fa-arrow-up arrow_sorting" arrow_value="issuepriorityid_u"></i>
              Priority </th>
              <!-- <th>Estimate</th> -->
              <th>
                 <i class="fa fa-arrow-down arrow_sorting" arrow_value="updatedat_d"></i> 
                <i class="fa fa-arrow-up arrow_sorting" arrow_value="updatedat_u"></i>
              Updated </th>
              <th width="8%">
                 <i class="fa fa-arrow-down arrow_sorting" arrow_value="deadline_d"></i> 
                <i class="fa fa-arrow-up arrow_sorting" arrow_value="deadline_u"></i>
              deadline </th>
              <!--  <th>Actions</th> -->
            </tr>
          </thead>

          <tbody style="overflow: hidden !important;" class="my_issues_tbody">


            @include('all_issues_my_issues')



          </tbody>

        </table>
      </div>
      <div class=""></div>
    </div>

  </div>
</div>
</div>
<style>
  .dataTables_wrapper .dataTables_length {
    margin-left: -12px;
  }
</style>
<script type="text/javascript">

  $( document ).ready(function() {

    $('body').on('click','.issuedelbtn',function(e){
     e.preventDefault();

     var issueid = $(this).attr('data');



     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });


     $.ajax({
      url: 'issue/'+issueid,
      type: 'DELETE',
      data: {
        "issueid": issueid
      },
      success: function(response){
        $.iaoAlert({msg: "Data has been deleted",
          type: "success",
          mode: "dark",});
              setTimeout(function(){// wait for 5 secs(2)
                location.reload(); // then reload the page.(3)
              }, 1500);
            }
          });
   });

    $('body').on('click','.arrow_sorting',function(e){
     e.preventDefault();

     var arrow_value = $(this).attr('arrow_value');

     var selectAssignee = $("#selectAssignee").val();
     var selectProject = $("#selectProject").val();
     //var is_complete = $("#is_complete").val();

     if($("#is_complete").prop('checked') == true){
      var is_complete = $("#is_complete").val();
    }
    else{
      var is_complete = 0;
    }



    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });


    $.ajax({
      url: 'issue_search_by_sort',
      type: 'POST',
      data: {
        "selectProject": selectProject,
        "selectAssignee": selectAssignee,
        "is_complete": is_complete,
        "arrow_value": arrow_value
      },
      success: function(response){
        //alert(response);
        $('.my_issues_tbody').html('');
        if(response){
         $('.my_issues_tbody').html(response);
       }

     }
   });
  });


  });

  $('#select_all').on('click',function(){
   $('.checkbox').each(function(){
    this.checked = true;
  });
 });

  $('#clear_all').on('click',function(){
   $('.checkbox').each(function(){
    this.checked = false;
  });
 });

  



  $(document).ready(function(){
   // Initialize
   $('#my_isssues_datatable').DataTable({

     "bSort": false

     // 'columnDefs': [ {
     //    'targets': [0,1,2,3,4,5,6,7,8,9], // column index (start from 0)
     //    'orderable': false, // set orderable false for selected columns
     //  }]



      // "aaSorting": []


    });

    // $('#my_isssues_datatable').dataTable({
    //     "aaSorting": []
    // });


  });



</script>
@endsection
