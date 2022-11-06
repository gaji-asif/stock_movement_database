@extends('master_main')
@section('mainContent')

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


        <h6 class="card_body_header" style="padding-left: 0px;float: left">Priority List</h6>
        <span style="float: right;"><a href="{{route('priority-create')}}" class="pull-right btn btn-success btn-sm dtb_custom_btn_default">Add Priority</a></span>
            <div class="table-responsive">
              <table class="table table-striped table-bordered dtb_custom_tbl_common" id="projectlisttbl">
                    <thead>
                        <tr class="text-center">
                            <th style="display: none;"></th>
                            <th width="5%">#SL</th>
                            <th width="40%">Priority Name</th>
                            <th width="40%">Colors</th>
               
                          <th width="10%" style="width: 1px !important;padding: 0px !important">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="tablecontents">
                        @php $sl = 1; @endphp
                        @if(isset($dtbpriorities))
                            @foreach($dtbpriorities as $value)
          
                                
                                   <div>
                                    <tr class="odd gradeX projectlist row1" data-id="{{ $value->id }}" id="{{$value->id}}">
                                    <td style="display: none;">{{$value->id}}</td>
                                    <td width="20px">
                                      <a href="#">
                                      <div class="text-center" style="cursor: pointer;" title="change display order">
                                        <div style="display: flex;color: #00000063;"> <i class="fas fa-th-list d-block"></i></div>
                                      <!-- <i class="fa fa-ellipsis-v"></i>
                                      <i class="fa fa-ellipsis-v"></i> -->
                                      </div>
                                      </a>
                                    </td>
                                    <td class="proname text-center"><a href="{{ route('priority-edit', ['id' => $value->id]) }}">{{$value->priority_name}}</a></td>
                                  <!--   <td class="proname"><a href="{{ route('category-edit', ['id' => $value->id]) }}">{{$value->color}}</a></td> -->

                                  <td class="text-center" href="{{ route('priority-edit', ['id' => $value->id]) }}"><button class="btn btn-sm" style="color:white;background: {{ $value->color }}">{{ $value->priority_name }}</button></td>


                                 
                                    
                                    <td class="text-center"><a href="{{ route('priority-edit', ['id' => $value->id]) }}"><span class="glyphicon glyphicon-edit" style="color: black"></span></a></td>
                                    </tr>
                                   </div>
                                </a>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

      </div>
    </div>
  </div>

</div>

</div>
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

      $('#projectlisttbl').DataTable( {
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
        url: 'priorityorder',
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
