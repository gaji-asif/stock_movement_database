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
    .upload_btn{
        position: absolute !important; 
        right: -10px !important;
        bottom: 5px !important;
    }
    .card>img{
        height: 154px !important;
    }
    
</style>

<input type="hidden" id="student_id" value="@if(isset($editData)){{$editData->id}}@endif">
<div class="row">
    <div class=" col-lg-12">
        <div class="col-md-12 pull-right mb-2">
            <a href="javascript:void(0)" class="btn btn-success btn-sm upload_btn dtb_custom_btn_default pull-right " data-toggle="modal" data-target=".custome_notes_upload_modal">New Note</a>
                  <div class="modal fade bd-example-modal-lg custome_notes_upload_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                          <div class="modal-header" style="padding-bottom: 0px !important">
                            <h4>New Note Upload</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="color:black">×</span>
                              </button>
                          </div>
                          <form action="" id="custome_note_upload_form" method="POST" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-6 form-group">
                                        <label class="form-label font-weight-bold fs-14">{{ __('Facility Type') }}
                                            <span class="text-muted">{{ __('*') }}</span></label>
                                            <select class="form-control" id="exampleFormControlSelect1" name="facility_type" required>
                                                <option >Select A facility Type</option>
                                                @if(isset($facilityType))
                                                    @foreach($facilityType as $key => $value)
                                                        <option value="{{$value->id}}">{{$value->type_name}}</option>
                                                    @endforeach
                                                @endif
                                              </select>
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label class="form-label font-weight-bold fs-14">{{ __('Upload Documents') }}
                                            <span class="text-muted">{{ __('*') }}</span></label>
                                        <input type="file" class="form-control" name="custome_notes_document_file" required>
                                    </div>
                                    <div class="col-lg-12 form-group ">
                                        <label class="form-label font-weight-bold fs-14">{{ __('Notes') }}
                                            <span class="text-muted">{{ __('*') }}</span></label>
                                            <textarea name="custome_notes" id="custome_notes_textearea" style="min-width: 100%" rows="5"></textarea>
                                    </div>
                                </div>
                              
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <a  class="btn btn-success custome_notes_submit-button dtb_custom_btn_default" >Upload</a>
                            </div>
                          </form>
                      </div>
                    </div>
                  </div>
        </div>
    </div>
</div>

<div class="row custome_note_doc_view">
    
   
    {{-- <div class="custome_note_doc_view"> --}}
        @if(isset($studentCustomeNotes))
            @foreach ($studentCustomeNotes as $studentCustomeNote)
                <div class="col-lg-4" >
                    <div class="card shadow-lg bg-white rounded">
                        @if(verifyExtention(get_extension(asset('uploads/'.$studentCustomeNote->doc_path)))) 
                            <img class="img-responsive" src="{{asset('uploads/'.$studentCustomeNote->doc_path)}}" width="100%" height="154px">
                        @else
                            <iframe src='https://docs.google.com/gview?url={{asset('uploads/'.$studentCustomeNote->doc_path)}}&embedded=true'></iframe>
                        @endif
                        <div class="card-footer">
                            <p>@if(strlen($studentCustomeNote->facilityType->type_name) > 20){{substr($studentCustomeNote->facilityType->type_name, 0, 18) . '...'}}@else{{$studentCustomeNote->facilityType->type_name}} @endif</p>
                            <a data-url="{{asset('uploads/'.$studentCustomeNote->doc_path)}}" hrf="javascript:void(0)" style="color: white" class="btn btn-sm btn-primary show-custome_note_doc_modal">Preview</a>
                            <a href="{{asset('uploads/'.$studentCustomeNote->doc_path)}}" download class="btn btn-sm btn-primary">Download</a>
                            <button type="button" class="btn btn-sm btn-primary mt-1 show-custome_note_modal" data-student_custome_note_id="{{$studentCustomeNote->id}}" style="padding : 3px 48px">See Note</button>
                        </div>
                    </div>
                </div>
                {{-- <div class="modal  fade " id="show-notes-modal_{{$studentCustomeNote->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                          <div class="card-header" style="padding-bottom: 0px !important">
                              <h5>Note</h5>
                          </div>
                        <div class="modal-body">
                            {{$studentCustomeNote->notes}}
                        </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          </div>
                      </div>
                    </div>
                </div> --}}
            @endforeach
        @endif
    {{-- </div> --}}
    
</div>

<div class="modal custome_note_doc_modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="card-header custome-header" style="padding-bottom: 0px !important">
            
        </div>
        <div class="custome_note_doc-modal-body"></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
      </div>
    </div>
</div>

<input type="hidden" id="baseUrl" value="{{url('/')}}">
<script>
    $(document).ready(function(){

 

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
        $(document).on('click','.show-custome_note_doc_modal',function(){
            var doc_url = $(this).data('url');
            let extentionType = doc_url.split('.').pop()
            $('.custome_note_doc-modal-body').html('');
            $('.custome-header').html('');
            isImage(extentionType) ? 
            $('.custome_note_doc-modal-body').html('<img src="'+doc_url+'" style="width:100%" >') :
            $('.custome_note_doc-modal-body').html('<iframe src="https://docs.google.com/gview?url='+doc_url+'&embedded=true" style="width:100%;height:700px" > </iframe>')
            $('.custome_note_doc_modal').modal('show');
        });   
        $(document).on('click','.show-custome_note_modal',function(){
           baseUrl = $('#baseUrl').val();
            student_custome_note_id = $(this).data('student_custome_note_id');
            $.ajax({
                url: `${baseUrl}/get_student_custome_notes/${student_custome_note_id}`,
                type: 'get',
                success: function(res){
                    
                    if(res.status == 'suceess'){
                        let noteViewerDiv = `<div style="padding:25px">${res.data.notes}</div>`
                        $('.custome-header').html('');
                        $('.custome-header').html('Note');
                        $('.custome_note_doc-modal-body').html('');
                        $('.custome_note_doc-modal-body').append(noteViewerDiv);
                        $('.custome_note_doc_modal').modal('show');
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
    });

    $(document).ready(function(){

     
       
        $(document).on('click','.custome_notes_submit-button',function(e){
          
            toastr.info("Please wait a minute.Thank you");
            e.preventDefault();
            student_id = $('#student_id').val();
            facility_type = $('select[name=facility_type]').val();
            custome_notes_textearea = $('#custome_notes_textearea').val();
            custome_notes_document_file = $('input[name=custome_notes_document_file]')[0].files[0];
            var formData = new FormData();
            formData.append('facility_type',facility_type);
            formData.append('notes',custome_notes_textearea);
            formData.append('doc_file',custome_notes_document_file);
            formData.append('student_id',student_id);
                 $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
               
            $.ajax({
                url: "{{url('/student_custome_notes')}}",
                type: 'POST',
                data:formData,
                contentType: false,
                processData: false,
                success: function(res){
                    
                    if(res.status == 'suceess'){
                        toastr.success(res.message);
                        $('.custome_notes_upload_modal').modal('hide');
                        $('#custome_note_upload_form')[0].reset();
                        $(".overlay-spinner").hide();
                        makeNewDocViewer(res);
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

        function makeNewDocViewer(res)
        {
            let baseUrl = $('#baseUrl').val();
            let doc_path = baseUrl+'/uploads/'+res.data.doc_path;
            let getCardPreview = isImage(res.data.type) ?
            `<img src="${doc_path}"  width="100%" height="154px">` :
                `<iframe src="https://docs.google.com/gview?url=${doc_path}&embedded=true"></iframe>`;
            facilityName = res.data.facility_type ?res.data.facility_type.type_name:'';
            let docViewerDiv = `
            <div class="col-lg-4" >
                <div class="card shadow-lg bg-white rounded">
                    ${getCardPreview}
                    <div class="card-footer">
                        <p>${facilityName}</p>
                        <a data-url="${doc_path}" hrf="javascript:void(0)" style="color: white" class="btn btn-sm btn-primary show-custome_note_doc_modal">Preview</a>
                        <a href="${doc_path}" download class="btn btn-sm btn-primary">Download</a>
                        <button type="button"   class="btn btn-sm btn-primary mt-1 show-custome_note_modal" data-student_custome_note_id="${res.data.id}"  style="padding : 3px 48px">See Note</button>
                    </div>
                </div>
            </div>
            `;
           
            $('.custome_note_doc_view').append(docViewerDiv);
        }
    });

  
</script>