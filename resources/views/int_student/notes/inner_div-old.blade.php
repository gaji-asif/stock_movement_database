<style>
    .card>img{
        height: 138px;
    }
    .card-footer{
       text-align: center;
    }
    p{
        margin-bottom: 3px !important;
    }
    .col-lg-4{
        margin-bottom: 15px;
        cursor: pointer;
    }
    .notes_btn{
        position: absolute !important; 
        right: 12px !important;
        bottom: 5px !important;
    }
    .card>img{
        height: 154px !important;
    }
    .note-body{
        padding-top: 0px !important;
        padding-bottom: 0px !important;
    }
</style>

<input type="hidden" id="student_id" value="@if(isset($editData)){{$editData->id}}@endif">
<div class="row doc_div">
    <div class="col-lg-12">
        <div class="col-md-12 pull-right mb-2">
            <a href="javascript:void(0)" class="btn btn-success btn-sm notes_btn dtb_custom_btn_default pull-right " data-toggle="modal" data-target=".note_modal">New Note</a>
                  <div class="modal fade  note_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-fat">
                      <div class="modal-content">
                          <div class="modal-header" style="padding-bottom: 0px !important">
                            <h4>New Note Upload</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="color:black">×</span>
                              </button>
                          </div>
                          <form action="" id="note_upload_form" method="POST" enctype="multipart/form-data">
                            <div class="modal-body note-body" >
                              
                                <div class="form-group ">
                                    <label class="form-label font-weight-bold fs-14 p-1">{{ __('Notes') }}
                                        <span class="text-muted">{{ __('*') }}</span></label>
                                        <textarea name="notes" id="notes_textearea" style="min-width: 100%" rows="5"></textarea>
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <a  class="btn btn-success submit-note-button dtb_custom_btn_default" >Submit</a>
                            </div>
                          </form>
                      </div>
                    </div>
                  </div>
        </div>
    </div>
    <div class="notes_div">
        @if(isset($studentNotes))
            @foreach ($studentNotes as $studentNote)
                <div class="col-lg-12 mb-2">
                    <div class="card shadow-lg bg-white rounded">

                        <div class="card-body w-100">
                            <p>{{date('Y-m-d h:i A',strtotime($studentNote->created_at))}}</p>
                            <div>
                                {{$studentNote->notes}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

<input type="hidden" id="baseUrl" value="{{url('/')}}">
<script>


    $(document).ready(function(){

     
       
        $(document).on('click','.submit-note-button',function(e){
            
            
            toastr.info("Please wait a minute.Thank you");
            e.preventDefault();
            student_id = $('#student_id').val();
            notes = $('#notes_textearea').val();
            var formData = new FormData();
            formData.append('notes',notes);
            formData.append('student_id',student_id);
                 $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
               
            $.ajax({
                url: "{{url('/student_notes')}}",
                type: 'POST',
                data:formData,
                contentType: false,
                processData: false,
                success: function(res){
                    if(res.status == 'suceess'){
                        toastr.success(res.message);
                        $('.note_modal').modal('hide');
                        $('#note_upload_form')[0].reset();
                        $(".overlay-spinner").hide();
                        makeNewNoteViewer(res);
                    }else{
                        toastr.error("Something went wrong");
                    }
                },
                error: function(res){
                    var errors = data.responseJSON;
                    if(errors.errors){
                        toastr.error(errors.errors);
                    }
                }
            });
           
        });

      
        
        function makeNewNoteViewer(res)
        {
            dateFormat = dateFormat(`${res.data.created_at}`);
           
            var noteViewer = `
            <div class="col-lg-12 mb-2" >
                <div class="card shadow-lg bg-white rounded">
                    <div class="card-body w-100">
                        <p>${dateFormat}</p>
                        <div> ${res.data.notes}</div>
                    </div>
                </div>
            </div>
            `;
            $('.notes_div').prepend(noteViewer);
        }

        function dateFormat(newDate)
        {
            
            var d = new Date(newDate);
            var datestring = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate()  + " " + formatAMPM(d);
            return datestring;
        }
        function formatAMPM(date) {
            var hours = date.getHours();
            var minutes = date.getMinutes();
            var ampm = hours >= 12 ? 'pm' : 'am';
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            minutes = minutes < 10 ? '0'+minutes : minutes;
            var strTime = hours + ':' + minutes + ' ' + ampm;
            return strTime;
        }
    });

  
</script>