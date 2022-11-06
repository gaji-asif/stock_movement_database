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
        right: -10px !important;
        bottom: 5px !important;
    }
    .card>img{
        height: 154px !important;
    }
    .note-body{
        padding-top: 0px !important;
        padding-bottom: 0px !important;
    }
    td >p {
        color: black !important;
        font-weight: 400 !important;
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
                            <div class="modal-body note-body row pt-2" >
                                <div class="col-lg-6 form-group">
                                    <label class="form-label font-weight-bold fs-14 mt-1">{{ __('Template') }}</label>
                                        <select class="form-control" id="select_template_notes" name="template" required>
                                            <option >Select A Template</option>
                                            @if(isset($templates))
                                                @foreach($templates as $key => $template)
                                                    <option value="{{$template->id}}">{{$template->name}}</option>
                                                @endforeach
                                            @endif
                                          </select>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label class="form-label font-weight-bold fs-14">{{ __('Upload Documents') }}
                                        <span class="text-muted">{{ __('*') }}</span></label>
                                    <input type="file" class="form-control" name="note_doc_file" required>
                                </div>
                                <div class="col-lg-12 form-group ">
                                    <label class="form-label font-weight-bold fs-14 ">{{ __('Notes') }}
                                        <span class="text-muted">{{ __('*') }}</span></label>
                                        <textarea name="student_notes"  style="min-width: 100%" rows="5"></textarea>
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
    <div id="notes_div">
        @include('int_student.notes.inner_div_data')
    </div>
</div>
<div class="modal notes_doc_modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="card-header custome-header" style="padding-bottom: 0px !important">
            
        </div>
        <div class="notes_doc-modal-body"></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
      </div>
    </div>
</div>

<input type="hidden" id="baseUrl" value="{{url('/')}}">


<script>


    $(document).ready(function(){

        $(document).on('change','#select_template_notes',function(e){
            e.preventDefault();
            id = $(this).val();
            var formData = new FormData();
            formData.append('id',id);
                 $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
               
            $.ajax({
                url: "{{url('/get-template')}}",
                type: 'POST',
                data:formData,
                contentType: false,
                processData: false,
                success: function(res){
                    if(res){
                        CKEDITOR.instances['student_notes'].setData(res.description);
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
        $(document).on('click','.note_delete',function(e){
            e.preventDefault();
            id = $('input[name=student_note_id]').val();
            var formData = new FormData();
            formData.append('id',id);
                 $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
               
            $.ajax({
                url: "{{url('/delete-note')}}",
                type: 'POST',
                data:formData,
                contentType: false,
                processData: false,
                success: function(res){
                    if(res){
                        toastr.success('Student Note deleted successfully');
                        $("#showDetaildModal").modal('hide');
                        $("#notes_div").html('');
                        $("#notes_div").html(res);
                        // makeNewNoteViewer(res);
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
        $(document).on('click','.show-notes_doc_modal',function(){   
            var doc_url = $(this).data('url');
            let extentionType = doc_url.split('.').pop()
            $('.notes_doc-modal-body').html('');
           
            isImage(extentionType) ? 
            $('.notes_doc-modal-body').html('<img src="'+doc_url+'" style="width:100%" >') :
            $('.notes_doc-modal-body').html('<iframe src="https://docs.google.com/gview?url='+doc_url+'&embedded=true" style="width:100%;height:700px" > </iframe>')
            $('.notes_doc_modal').modal('show');
        }); 
        $(document).on('click','.submit-note-button',function(e){
            
            
            toastr.info("Please wait a minute.Thank you");
            e.preventDefault();
            student_id = $('#student_id').val();
            noteDocFile = $('input[name=note_doc_file]')[0].files[0];
            notes =   CKEDITOR.instances['student_notes'].getData();
            var formData = new FormData();
            formData.append('notes',notes);
            formData.append('doc_file',noteDocFile);
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
                    if(res){
                        toastr.success('Student Notes added successfully');
                        $('.note_modal').modal('hide');
                        $('#note_upload_form')[0].reset();
                        $(".overlay-spinner").hide();
                        $("#notes_div").html('');
                        $("#notes_div").html(res);
                        // makeNewNoteViewer(res);
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

        function isImage(extension) {
            switch (extension.toLowerCase()) {
                case 'jpg':
                case 'png':
                case 'jpeg':
                    return true;
                default:
                    return false;
            }
        }

        
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

   CKEDITOR.replace('student_notes');
  
  
</script>