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
  <span class="px-2 font-weight-bold text-uppercase">{{ $DtbChecklistsingle['title'] ?? "" }}</span>
</div>
</div>

<hr class="border-light m-0">

<div class="card-body">


    <form method="POST" class="modal-content" id="checklistsubmitform">

      <div class="form-row pt-3 pl-3 insertformholder">
      <div class="form-group  col-md-2">
        <label class="form-label mt-2">Checklist Title</label>
      </div>
      <div class="form-group col-md-8">
      
      <input required type="text" id="title" name="title" value="{{ old('title') }}" class="form-control required" placeholder="">
      </div>
      <div class="form-group  col-md-2">
          <input type="hidden" name="project_id" value="{{$id}}">
          <input type="hidden" name="chcklistid" value="{{$chcklistid}}">
          <button type="submit" class="btn btn-secondary ml-3 mt-0">Submit</button>
      </div>
      </div>

    </form>

  <br>

    <div class="row">
      <div class="col-md-12">
        <div class="checklistcontainer">
          <div class="list modal-content px-2 py-2 mb-2">
            <ul id="showlist" class="showlist"></ul>
          </div>
        </div>
      </div>
    </div>



</div>



</div>


</div>
</div>




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
<input type="hidden" name="chcklistid" value="{{$chcklistid}}">


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
<button  value="{{ $checklist->id ?? '' }} type="button" class="btn btn-danger issuedelbtn" data-dismiss="modal">YES wwwwwwwwww</button>

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


<script type="text/javascript">
$( document ).ready(function() {
   

                    
                    //issue entry form submit process
                    $('body').on('submit','#checklistsubmitform',function(e){
                                e.preventDefault();
                                 $.ajaxSetup({
                                 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                                 });
                                 

                                 var formdata = $(this).serialize();
                                 
                                 var url = '{{ url("checklist") }}';
                                 
                                 $.ajax({
                                        url: ''+{{ $chcklistid }}+'/add',
                                        type: 'POST',
                                        data: formdata,
                                        
                                        success: function(data){
                                        // $.iaoAlert({msg: "Data has been saved",
                                        // type: "success",
                                        // mode: "dark",})
                                        // // showdata();
                                        getlistoflist();
                                        document.getElementById("checklistsubmitform").reset();
                                        
                                        $.iaoAlert({msg: "List added !",
                                                   type: "success",
                                                   mode: "dark",});
                                        
                                        // setTimeout(function(){// wait for 5 secs(2)
                                        //            location.reload(); // then reload the page.(3)
                                        //            }, 1000);
                                        
                                        
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



                    getlistoflist();
                    function getlistoflist(){
                        $.ajax({
                            url: ''+{{ $chcklistid }}+'/getlist',
                           type: 'GET',
                           data: {
                           listid:{{ $chcklistid }},
                           _token: '{{csrf_token()}}'
                           },
                           success: function(response){
                           if (response) {

                            $("#showlist").html(response);

                           }
                           },
                           error: function() {
                           alert('Error occurs!');
                           }
                        });
                    }







                    
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
                            $('body').on('click','.delcheckdtail',function(e){
                                var listid = $(this).attr('data');
                                e.preventDefault();
                               
                              $.ajaxSetup({
                               headers: {
                               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                               }
                              });
                                 
                                 
                                 $.ajax({
                                        url: ''+{{ $chcklistid }}+'/delete',
                                        type: 'DELETE',
                                        data: {
                                        "listid": listid
                                        },
                                        success: function(response){
                                        getlistoflist();
                                        $.iaoAlert({msg: "Data has been deleted",
                                                   type: "success",
                                                   mode: "dark",});


                                         setTimeout(function(){
                                            location.reload();
                                          }, 1000);

                                        
                                        }

                                        });

                            });



                  
                  $('body').on('click','.editcheckdtail',function(e){

                    var thisid = $(this).attr("data");

                    $(".insertformholder label").hide();
                    $(".insertformholder input").hide();
                    $(".insertformholder button").hide();
                    $(".dtailchckp_"+thisid+"").hide();
                    $(".editcheckdtail").hide();

                    $(".delcheckdtail").hide();
                    $("#editcancel_"+thisid+"").show();

                    $(".inlineinput_"+thisid+"").show();
                    // $(this).parents("input").show();
                    $("#editcheckdtaildone_"+thisid+"").show();
                    $("#showlist").toggleClass('showlist newclass');
                  });  


                  $('body').on('click','.editcancel',function(e){
                    getlistoflist();
                    var thisid = $(this).attr("data");

                    $(".listli").show();
                    $(".editcheckdtail").show();

                    $(".delcheckdtail").show();
                    $("#editcancel_"+thisid+"").hide();

                    $(".inlineinput_"+thisid+"").hide();
                    // $(this).parents("input").hide();
                    $("#editcheckdtaildone_"+thisid+"").hide();
                    $("#showlist").toggleClass('showlist newclass');

                    $(".insertformholder label").show();
                    $(".insertformholder input").show();
                    $(".insertformholder button").show();

                    
                  });                  


                  $('body').on('click','.editcheckdtaildone',function(e){
                    
                    $.ajaxSetup({
                                headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                                });

                    var thisid = $(this).attr("data");
                    var dtaillistid = $(this).attr('data');
                    var editedvalue = $(".inlineinput_"+thisid+"").val();

                     $.ajax({
                            url: ''+{{ $chcklistid }}+'/edit',
                            type: 'PUT',
                            data: {
                            "dtaillistid": dtaillistid,
                            "editedvalue": editedvalue
                            },
                            success: function(response){

                            getlistoflist();
                            $.iaoAlert({msg: "Data has been updated",
                                       type: "success",
                                       mode: "dark",});
                            $(".listli").show();
                              $(".editcheckdtail").show();

                              $(".delcheckdtail").show();
                              $("#editcancel_"+thisid+"").hide();

                              $(".inlineinput_"+thisid+"").hide();
                              // $(this).parents("input").hide();
                              $(".editcheckdtaildone").hide();
                              $("#showlist").toggleClass('showlist newclass');

                              $(".insertformholder label").show();
                              $(".insertformholder input").show();
                              $(".insertformholder button").show();


                          }

                    });

                    // $(".listli").hide();
                    // $(".editcheckdtail").hide();
                    // $(".inlineinput").show();
                    // $(".editcheckdtaildone").show();
                    // $("#showlist").toggleClass('showlist newclass');
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


<style>
ul.showlist li {
    padding-top: 16px;
    text-transform: capitalize;
    overflow: hidden;
    box-shadow: 0 0 5px #e1e1e1;
    padding-bottom: 0px;
    margin-top: 7px;
}
/*li.singlechcklist:before {
    content: "";
    position: absolute;
    left: 14px;
    height: 100%;
    top: 0;
    border-left: 2px solid #F4CD80;
}*/

.newclass li.singlechcklist:before {
    content: "";
    position: absolute;
    left: 14px;
    height: 100%;
    top: 0;
    border-left: 0px solid #F4CD80;
}
ul.newclass li {
    background: #f5f5f561;
    padding: 4px 9px;
    border-bottom: 1px solid #e1e1e1;
    padding-top: 15px;
    text-transform: capitalize;
    overflow: hidden;
    padding-bottom: 0px;
}

.showlist {
    list-style: none;
    padding: 10px;
}
.newclass {
    list-style: none;
    padding: 10px;
}
.iconholder a:first-child {
    margin-right: 15px;
    margin-top: -3px;
    /* font-size: 14px; */
}
.singlechcklist p {
    float: left;
    width: 90%;
    color: #0707078a;
    margin-left: 11px;
    font-weight: 500;
    font-size: 15px;
}
.iscomplete i{
    padding-right: 4px;
    padding-bottom: 1px;
    float: left;
    margin-top: 1px;
}

.newclass .iconholder a {
    display: flex;
    margin-top: 7px;
    margin-left: 13px;
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

.iconholder {
float: right;
    /* margin-top: 12px; */
    display: flex;
    margin-right: 9px;
    margin-top: 4px;
}
.newclass .iconholder {
    float: right;
    /* margin-top: 12px; */
    display: flex;
    margin-right: 2px !important;
    margin-top: 4px;
}
.singlechcklist input {
    float: left;
    margin-top: -5px;
    margin-bottom: 12px;
    width: 92%;
    height: 45px;
    padding-left: 4px;
    border: 1px solid lightgray;
    border-radius: 4px;
}

ul.showlist li:hover a {
    /* background: white !important; */
    opacity: 1 !important;
}
ul.showlist li a {
  opacity: -0.7;
}
a.editcheckdtaildone {
    font-size: 16px;
    color: #008600;
}
a.editcancel {
    font-size: 16px;
    color: #8b21219e;
}
</style>

@endsection

