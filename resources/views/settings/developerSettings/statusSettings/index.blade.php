@extends('master_main')
@section('mainContent')
<?php  $param = '';?>
<div class="container pt-5">
  <div class="row">
    <div class="col-lg-3">
     @include('settings.developerSettings.developer_settings_sidebar')
   </div>

   <div class="col-lg-9 settgs_right_content">
    <div class="card mb-4 no_border">
      <div class="card-body">

        @if(session()->has('message'))

        <div class="alert success_message mb-10 background-success" role="alert">
          {{ session()->get('message') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        @endif


        <h6 class="card_body_header" style="padding-left: 0px;float: left">Status List</h6>
        <span style="float: right;"><a href="{{route('statuss-create')}}" class="pull-right btn btn-success btn-sm dtb_custom_btn_default">Add Status</a></span>
        <div class="table-responsive">
          <table class="table table-bordered table-striped dtb_custom_tbl_common" id="statuslist">

            <thead>
              <tr>
               
                <th style="width: 13.6px;"></th>
                <th style="width: 290px;"> List of Status</th>
                <th style="width: 180px;">Colors</th>
                <th style="width: 150px;"></th>
                <th style="width: 40.6px;">Action</th>
              </tr>
            </thead>

            <tbody id="tablecontents">


              @forelse ($statusss as $status)

              <tr class="row1" data-id="{{ $status->id }}" id="{{$status->id}}">
                <td class="sorted" data-value="">
                  <div style="display: flex;color: #00000063;"> <i class="fas fa-th-list d-block"></i></div>
                </td>
              
                <td data-value="{{ $status->color }}">{{ $status->status_name }}</td>
                <td data-value="{{ $status->status_name }}"><button class="btn btn-sm" style="color:white;background: {{ $status->color }}">{{ $status->status_name }}</button></td>
                <td class="text-center">
                  <?php if ($status->is_complete == '1')
                  { ?>

                    <a href="javascript:void(0)" class="badge badge-outline-success iscomplete" style="display: inline-flex;padding: 3px 6px 3px 7px;">
                      <i class="fas fa-check-square d-block" style="font-size: 14px; padding-right: 5px;"></i>
                      <span class="pull-right" style="margin-top: 1px;">completed</span>
                    </a>

                  <?php }elseif ($status->is_feedback == '1')
                  { ?>

                    <a href="javascript:void(0)" class="badge badge-outline-success iscomplete" style="display: inline-flex;padding: 3px 6px 3px 7px;">
                      <i class="fas fa-check-square d-block" style="font-size: 14px; padding-right: 5px;"></i>
                      <span class="pull-right" style="margin-top: 1px;">feedbacked</span>
                    </a>

                  <?php }else{ ?>
                    <a href="javascript:void(0)" class="badge badge-outline-info iscomplete" style="display: inline-flex;padding: 3px 25px 3px 22px;">
                      <i class="fas fa-angle-double-up d-block" style="padding-right: 5px;"></i>
                    Open</a>
                  <?php } ?>
                </td>


                <td data-value="{{ $status->id }}" style="display: flex;padding: 15px 32px;">
                  <a href="{{ route('statuss-edit', ['id' => $status->id]) }}" class="mr-2 statuseditmodal" value="{{ $status->id }}" data-status="{{$status->status_name}}" data-issuecolor="{{$status->color}}"  data-completed="{{$status->is_complete}}" data-feedbacked="{{$status->is_feedback}}"><i class="far fa-edit d-block"></i></a>
                  <a href="#" id="condition_valuess" data-toggle="modal" data-target="#statusdelconfrimmodal" class="statusdelconfrimmodal" onclick="take_condition_id('<?php echo $status->condition_id; ?>');" value="{{ $status->id }}" condition_value="{{ $status->id }}"><i class="far fa-trash-alt d-block"></i></a>
                </td>
              </tr>

              <div class="modal fade" id="statusdelconfrimmodal" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header" style="background-color: #f8d7da;">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h6 class="modal-title">Are you sure to delete?</h6>
                    </div>
<!-- <div class="modal-body">
<p>Some text in the modal.</p>
</div> -->

<?php
if(empty($status->condition_id)){
$param = $status->id;
}
else{
 $param = $status->condition_id; 
}
?>
{!! Form::open(['url' => ['status_delete'], 'enctype' => 'multipart/form-data', 'id' => 'wikieditform', 'class' => 'pl-3'])!!}
      {{ method_field('post') }}

      <input type="hidden" id="condition_id" name="condition_id">
<div class="modal-footer">
  <button type="button" class="btn btn-primary" data-dismiss="modal">CANCEL</button>
 <!--  <a href="{{route('status-delete', $param)}}"><button type="submit" class="btn btn-danger">YES</button></a> -->
  <button type="submit" class="btn btn-danger">YES</button>

</div>
 {{ Form::close()}}
</div>


</div>
</div>


@empty
<p></p>
@endforelse
</tbody>
<!-- <tfoot>
<tr>
<th></th>
<th></th>
<th></th>
<th></th>
<th></th>
</tr>
</tfoot> -->
</table>
</div>

</div>
</div>
</div>

</div>

</div>


<script type="text/javascript">
  function take_condition_id(data){
   
    $("#condition_id").val(data);
  
  }
</script>

<style type="text/css">
  #projectlisttbl tr:hover td a{ color: #02BC77; }
  #projectlisttbl tr:hover { background: #f3f3f3; }
  #projectlisttbl tr td a {
    display: block;
    padding: 12px 9px;
  }
  #projectlisttbl tr td {
    padding:0px;
  }
  .projectlist td a {
    color: rgba(24,28,33,0.9);
  }
</style>

<script type="text/javascript">

  $( document ).ready(function() {

    $('#statuslist').DataTable( {
      "order": [],
      ordering:true
    } );



// PROJECT LIST DRAG DROP SORTING
$( "#tablecontents" ).sortable({
  items: "tr",
  cursor: 'move',
  opacity: 0.6,
  update: function() {
    sendOrderToServer();
  }
});
function sendOrderToServer() {


  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var order = [];
  $('tr.row1').each(function(index,element) {
    order.push({
      id: $(this).attr('data-id'),
      position: index+1
    });
       // alert(JSON.stringify(order, null, 4));exit();
     });
  $.ajax({
    url: 'statusorder',
    type: 'PUT',
    data: {
      order:order,
      _token: '{{csrf_token()}}'
    },
    success: function(response){
          //alert(response);
          $("#msgcontainer").show();
          if (response) {
            $.iaoAlert({msg: "Ordering Successfull",
              type: "success",
              mode: "dark",})
          }
        },
        error: function() {
          alert('Error occurs!');
        }
      });
}

});

</script>


@endsection
