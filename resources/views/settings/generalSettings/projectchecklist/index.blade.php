@extends('master')
@section('mainContent')
<div class="row">
  <div class="col-lg-2"></div>
  <div class="col-lg-8">
    <div class="card overflow-hidden">
<div class="row no-gutters row-bordered row-border-light">

<div class="col-md-2 pt-0">
@include('settings.generalSettings.general_settings_sidebar')
</div>

<div class="col-md-10">
<div class="tab-content">
<div class="tab-pane fade show active" id="account-general">

<div class="card-body media align-items-center pb-2">
<div class="media-body">
<button type="button" class="btn btn-outline-primary btn-sm md-btn-flat" data-toggle="modal" data-target="#checklistmodal"><i class="fa fa-plus" style="font-size:12px"></i> Add Checklist</button>
</div>
</div>

<hr class="border-light m-0">

<div class="card-body">

<table class="table table-bordered table-striped dtb_custom_tbl_common" id="checklistlist">

<thead>
<tr>
<th style="width: 13.6px;"></th>
<th style="width: 300px;"> Title</th>
<th style="width: 40.6px;">Action</th>
</tr>
</thead>

<tbody id="tablecontents">
@forelse ($DtbChecklist as $checklist)

<tr class="row1" data-id="{{ $checklist->id }}" id="{{$checklist->id}}">
<td class="sorted" data-value="">
<div style="display: flex;color: #00000063;"> <i class="fas fa-th-list d-block"></i></div>
</td>
<td data-value="{{ $checklist->title }}"><a href="checkdetail/{{ $checklist->id }}">{{ $checklist->title }}</a></td>

<td data-value="{{ $checklist->id }}" style="display: flex;padding: 15px 32px;">
<a href="#"  data-toggle="modal" data-target="#chcklisteditmodal" class="mr-2 chcklisteditmodal" value="{{ $checklist->id }}" data-title="{{$checklist->title}}" data-projectid='{{$id}}'><i class="far fa-edit d-block"></i></a>
<a href="#" data-toggle="modal" data-target="#checklistdelconfrimmodal" class="checklistdelconfrimmodal" value="{{ $checklist->id }}"><i class="far fa-trash-alt d-block"></i></a>
</td>
</tr>
@empty
<p>No data</p>
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
<span style="display: flex;margin-left: -10px;">
<i style="color: #00000063;margin-top: 3px;margin-right: 4px" class="fas fa-th-list d-block"></i> Drag  to rearrange order.
</span>

</div>



</div>


</div>
</div>



<!-- Modal template -->
<div class="modal fade" id="checklistmodal">
<div class="modal-dialog modal-md">
<form method="POST" class="modal-content" id="checklistsubmitform">

<div class="modal-header">
<h5 class="modal-title">
Add Chcklist
</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">✖</button>
</div>
<div class="modal-body">

<div class="errmsg alert alert-danger" style="display:none">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>


<div class="form-row">
<div class="form-group col-md-12">
<label class="form-label">Checklist Title</label>
<input required type="text" id="title" name="title" value="{{ old('title') }}" class="form-control required" placeholder="">
</div>
</div>


<!--  hidden field to get project id -->
<input type="hidden" name="project_id" value="{{$id}}">



</div>
<div class="modal-footer">
<button id="checklistclosebtn" class="btn btn-default" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary">Save</button>
</div>
</form>
</div>
</div>



<!-- MODAL FOR EDIT -->

<!-- Modal template -->
<div class="modal fade" id="chcklisteditmodal">
<div class="modal-dialog modal-md">
<form method="POST" class="modal-content" id="issuetypupdate">

<div class="modal-header">
<h5 class="modal-title">
Edit Checklist
</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">✖</button>
</div>
<div class="modal-body">

<div class="errmsg alert alert-danger" style="display:none">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>

<div class="form-row">
<div class="form-group col mb-0">
<label class="form-label">Checklist Title</label>
<input required type="text" id="edit_title" name="check_title" value="" class="form-control required" placeholder="">

</div>
</div>


<!--  hidden field to get project id and older color -->
<input type="hidden" name="project_id" value="{{$id}}">


</div>
<div class="modal-footer">
<button id="checklistclosebtn" class="btn btn-default" data-dismiss="modal">Close</button>
<button type="button" class="btn btn-primary updatechecklistsavebtn">Save</button>
</div>
</form>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="checklistdelconfrimmodal" role="dialog">
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
<div class="modal-footer">
<button type="button" class="btn btn-primary" data-dismiss="modal">CANCEL</button>
<button  value="{{ $checklist->id ?? '' }} type="button" class="btn btn-danger issuedelbtn" data-dismiss="modal">YES</button>

</div>
</div>

</div>
</div>

</div>
</div>
  </div>
  <div class="col-lg-2"></div>
</div>

<script src="{{asset('js/jscolor.js')}}"></script>
<style type="text/css">
.iscomplete i{
    padding-right: 4px;
    padding-bottom: 1px;
    float: left;
    margin-top: 1px;
}


  .btn-outline-primary {
    border: 1px solid #38587d;
    border-radius: 0px;
    color: #38587d;
}  

.btn-outline-primary:hover {
  background: #718AA8;
  color: white;
}

</style>

<script type="text/javascript">
$( document ).ready(function() {
                    // ##################################### CODE FOR STATUS START #####################################

                                        
                    // form required validation code
                    $("#checklistsubmitform").validate({
                                              rules: {
                                              messages: {
                                              title: {
                                              required: "Title field is required",
                                              }
                                              }
                                            }
                                              });
                    
                    
                    //issue entry form submit process
                    $('body').on('submit','#checklistsubmitform',function(e){
                                e.preventDefault();

                                 $.ajaxSetup({
                                 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                                 });
                                 

                                 var formdata = $(this).serialize();
                                 var check_title = $(this).attr('data-title');
                                 
                                 var url = '{{ url("checklist") }}';
                                 
                                 $.ajax({
                                        url: 'checklist',
                                        type: 'POST',
                                        data: formdata,
                                        
                                        success: function(data){
                                        // $.iaoAlert({msg: "Data has been saved",
                                        // type: "success",
                                        // mode: "dark",})
                                        // // showdata();
                                        alert(data);
                                        
                                        $('#checklistmodal').modal('hide');
                                        document.getElementById("checklistsubmitform").reset();
                                        
                                        $.iaoAlert({msg: "Data has been saved",
                                                   type: "success",
                                                   mode: "dark",});
                                        
                                        setTimeout(function(){// wait for 5 secs(2)
                                                   location.reload(); // then reload the page.(3)
                                                   }, 1000);
                                        
                                        
                                        },
                                        error: function (request, checklist, error) {
                                        $.iaoAlert({msg: "Please fill the field",
                                                   type: "warning",
                                                   mode: "dark",})
                                        
                                        
                                        
                                        json = $.parseJSON(request.responseText);
                                        $.each(json.errors, function(key, value){
                                               $('.errmsg').show();
                                               $('.alert-danger').append('<p>'+value+'</p>');
                                               setTimeout(function() {
                                                          $('.errmsg').hide();
                                                          $('.alert-danger').append('');
                                                          }, 2000);
                                               
                                               
                                               });
                                        $("#result").html('');
                                        }
                                        
                                        
                                        
                                        });
                                 
                                 
                                 });
                    
                    //issue modal closing input data reseting
                    $('#checklistclosebtn').on('click',function(e){
                                            e.preventDefault();
                                            document.getElementById("checklistsubmitform").reset();
                                            });
                    
                    
                    
                    $('#checklistlist').DataTable( {
                                               "order": [],
                                               ordering:true,
                                               } );
                    
                    
                    
                    
                    $('body').on('click','.chcklisteditmodal',function(e){
                                 
                                 e.preventDefault();
                                 
                                 var checklistid = $(this).attr('value');
                                 var projectid = $(this).attr('data-projectid');
                                 var check_title = $(this).attr('data-title');
                                 
                                 $("#edit_title").val(check_title);
                                 
                                 //$(".iscompleteornot").val(iscompletes);
                                 
                                 
                                 
                                 $('body').on('click','.updatechecklistsavebtn',function(e){
                                              e.preventDefault();

                                              var checklistvalue = $("#edit_title").val();
                                              
                                              $.ajaxSetup({
                                                          headers: {
                                                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                          }
                                                          });
                                              
                                              $.ajax({
                                                     url: 'checklist/'+projectid,
                                                     type: 'POST',
                                                     data: {
                                                     checklistid:checklistid,
                                                     projectid: projectid,
                                                     check_title: checklistvalue
                                                     },
                                                     success: function(response){
                                                     
                                                     $('#chcklisteditmodal').modal('hide');
                                                     $("#msgcontainer").show();
                                                     if (response) {
                                                     $.iaoAlert({msg: "Data has been updated",
                                                                type: "success",
                                                                mode: "dark",})
                                                     
                                                     setTimeout(function(){
                                                                window.location.href=window.location.href;
                                                                }, 1500);
                                                     }
                                                     }
                                                     });
                                              });
                                 
                                 
                                 
                                 
                                 });
                    
                    
                    
                    
                    // issue delete
                    $('body').on('click','.checklistdelconfrimmodal',function(e){
                                 var id = $(this).attr('value');
                                 e.preventDefault();
                                 
                                 //when confirm modal clicked
                                 $('body').on('click','.issuedelbtn',function(e){
                                              e.preventDefault();
                                              issuedelete();
                                              });
                                 
                                 
                                 function issuedelete() {
                                 
                                 $.ajaxSetup({
                                             headers: {
                                             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                             }
                                             });
                                 
                                 
                                 $.ajax({
                                        url: 'checklist',
                                        type: 'DELETE',
                                        data: {
                                        "id": id
                                        },
                                        success: function(response){
                                        
                                        $.iaoAlert({msg: "Data has been deleted",
                                                   type: "success",
                                                   mode: "dark",});
                                        
                                        setTimeout(function(){// wait for 5 secs(2)
                                                   location.reload(); // then reload the page.(3)
                                                   }, 1000);
                                        }
                                        });
                                 
                                 }
                                 });
                    
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
                           url: 'checklist',
                           type: 'PUT',
                           data: {
                           order:order,
                           _token: '{{csrf_token()}}'
                           },
                           success: function(response){
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

