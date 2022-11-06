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
        right: 12px !important;
        bottom: 5px !important;
    }
    .card>img{
        height: 154px !important;
    }
    
</style>

<input type="hidden" id="student_id" value="@if(isset($editData)){{$editData->id}}@endif">
<div class="row doc_div">
    <div class="col-lg-12">
        <div class="col-md-12 pull-right mb-2">
            <a href="javascript:void(0)" class="btn btn-success btn-sm upload_btn dtb_custom_btn_default pull-right " data-toggle="modal" data-target=".bd-example-modal-lg">New Upload Document</a>
                  <div class="modal fade bd-example-modal-lg upload_document_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                          <div class="modal-header" style="padding-bottom: 0px !important">
                            <h4>New Document Upload</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="color:black">×</span>
                              </button>
                          </div>
                          <form action="{{ route('student-upload.store') }}" id="document_uploa_form" method="POST" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="form-label font-weight-bold fs-14">{{ __('Document Name') }}
                                        <span class="text-muted">{{ __('*') }}</span></label>
                                    <input type="text" class="form-control" name="doc_name" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label font-weight-bold fs-14">{{ __('Upload Documents') }}
                                        <span class="text-muted">{{ __('*') }}</span></label>
                                    <input type="file" class="form-control" name="doc_file" required>
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <a  class="btn btn-success submit-button dtb_custom_btn_default" >Upload</a>
                            </div>
                          </form>
                      </div>
                    </div>
                  </div>
        </div>
    </div>
    {{-- cv --}}
    <div class="col-lg-4" >
        <div class="card shadow-lg bg-white rounded">
            @if(verifyExtention(get_extension(asset($editData->cv)))) 
                <img class="img-responsive" src="{{asset($editData->cv)}}" width="100%" height="154px">
            @else
                <iframe src='https://docs.google.com/gview?url={{asset($editData->cv)}}&embedded=true'></iframe>
            @endif
            <div class="card-footer">
                <p>CV</p>
                <a data-url="{{asset($editData->cv)}}" hrf="javascript:void(0)" style="color: white" class="btn btn-sm btn-primary doc-modal">Preview</a>
                <a href="{{asset($editData->cv)}}" download class="btn btn-sm btn-primary">Download</a>
            </div>
        </div>
    </div>
 
    {{-- Copy of passport --}}
    <div class="col-lg-4">
        <div class="card shadow-lg bg-white rounded">
            @if(verifyExtention(get_extension(asset('uploads/'.$editData->cp_passport)))) 
                <img class="img-responsive" src="{{asset('uploads/'.$editData->cp_passport)}}" width="100%" height="154px">
            @else
                <iframe src='https://docs.google.com/gview?url={{asset('uploads/'.$editData->cp_passport)}}&embedded=true'></iframe>
            @endif
            <div class="card-footer">
                <p>Copy of passport</p>
                <a data-url="{{asset('uploads/'.$editData->cp_passport)}}" hrf="javascript:void(0)" style="color: white" class="btn btn-sm btn-primary doc-modal">Preview</a>
                <a href="{{asset('uploads/'.$editData->cp_passport)}}" target="_blank" class="btn btn-sm btn-primary">Download</a>
            </div>
        </div>
    </div>

     {{-- SSC/O Levels certificate & Transcript --}}
    <div class="col-lg-4" >
        <div class="card shadow-lg bg-white rounded">
            @if(verifyExtention(get_extension(asset('uploads/'.$editData->cer_1)))) 
                <img class="img-responsive" src="{{asset('uploads/'.$editData->cer_1)}}" width="100%" height="154px">
            @else
                <iframe src='https://docs.google.com/gview?url={{asset('uploads/'.$editData->cer_1)}}&embedded=true'></iframe>
            @endif
            <div class="card-footer">
                <p>SSC/O Levels certif....</p>
                <a data-url="{{asset('uploads/'.$editData->cer_1)}}" hrf="javascript:void(0)" style="color: white" class="btn btn-sm btn-primary doc-modal">Preview</a>
                <a href="{{asset('uploads/'.$editData->cer_1)}}" download class="btn btn-sm btn-primary">Download</a>
            </div>
        </div>
    </div>
    
    {{-- HSC/A Levels certificate & Transcript --}}
    <div class="col-lg-4" >
        <div class="card shadow-lg bg-white rounded">
            @if(verifyExtention(get_extension(asset($editData->cer_2)))) 
                <img class="img-responsive" src="{{asset('uploads/'.$editData->cer_2)}}" width="100%" height="154px">
            @else
                <iframe src='https://docs.google.com/gview?url={{asset('uploads/'.$editData->cer_2)}}&embedded=true'></iframe>
            @endif
            <div class="card-footer">
                <p>HSC/A Levels certi...</p>
                <a data-url="{{asset('uploads/'.$editData->cer_2)}}" hrf="javascript:void(0)" style="color: white" class="btn btn-sm btn-primary doc-modal">Preview</a>
                <a href="{{asset('uploads/'.$editData->cer_2)}}" download class="btn btn-sm btn-primary">Download</a>
            </div>
        </div>
    </div>
   
    {{-- Bachelor degree certificate & Transcript For Master Application --}}
    <div class="col-lg-4" >
        <div class="card shadow-lg bg-white rounded" >
            @if(verifyExtention(get_extension(asset('uploads/'.$editData->cer_3)))) 
                <img class="img-responsive" src="{{asset('uploads/'.$editData->cer_3)}}" width="100%" height="154px">
            @else
                <iframe src='https://docs.google.com/gview?url={{asset('uploads/'.$editData->cer_3)}}&embedded=true'></iframe>
            @endif
            <div class="card-footer">
                <p>HSC/A Levels certifi...</p>
                <a data-url="{{asset('uploads/'.$editData->cer_3)}}" hrf="javascript:void(0)" style="color: white" class="btn btn-sm btn-primary doc-modal">Preview</a>
                <a href="{{asset('uploads/'.$editData->cer_3)}}" download class="btn btn-sm btn-primary">Download</a>
            </div>
        </div>
    </div>

    {{-- IELTS/ TOEFL/ Other --}}
    <div class="col-lg-4" >
        <div class="card shadow-lg bg-white rounded">
            @if(verifyExtention(get_extension(asset('uploads/'.$editData->cer_4)))) 
                <img class="img-responsive" src="{{asset('uploads/'.$editData->cer_4)}}" width="100%" height="154px">
            @else
                <iframe src='https://docs.google.com/gview?url={{asset('uploads/'.$editData->cer_4)}}&embedded=true'></iframe>
            @endif
            <div class="card-footer">
                <p>IELTS/ TOEFL/ Other</p>
                <a data-url="{{asset('uploads/'.$editData->cer_4)}}" hrf="javascript:void(0)" style="color: white" class="btn btn-sm btn-primary doc-modal">Preview</a>
                <a href="{{asset('uploads/'.$editData->cer_4)}}" download class="btn btn-sm btn-primary">Download</a>
            </div>
        </div>
    </div>
   
    {{-- Personal Statement --}}
    <div class="col-lg-4" >
        <div class="card shadow-lg bg-white rounded">
            @if(verifyExtention(get_extension(asset('uploads/'.$editData->cer_5)))) 
                <img class="img-responsive" src="{{asset('uploads/'.$editData->cer_5)}}" width="100%" height="154px">
            @else
                <iframe src='https://docs.google.com/gview?url={{asset('uploads/'.$editData->cer_5)}}&embedded=true'></iframe>
            @endif
            <div class="card-footer">
                <p>Personal Statement</p>
                <a data-url="{{asset('uploads/'.$editData->cer_5)}}" hrf="javascript:void(0)" style="color: white" class="btn btn-sm btn-primary doc-modal">Preview</a>
                <a href="{{asset('uploads/'.$editData->cer_5)}}" download class="btn btn-sm btn-primary">Download</a>
            </div>
        </div>
    </div>
   
    {{-- Job reference letter if there is any study gap upto 3 years --}}
    <div class="col-lg-4" >
        <div class="card shadow-lg bg-white rounded">
            @if(verifyExtention(get_extension(asset('uploads/'.$editData->cer_6)))) 
                <img class="img-responsive" src="{{asset('uploads/'.$editData->cer_6)}}" width="100%" height="154px">
            @else
                <iframe src='https://docs.google.com/gview?url={{asset('uploads/'.$editData->cer_6)}}&embedded=true'></iframe>
            @endif
            <div class="card-footer">
                <p >Job reference letter ....</p>
                <a data-url="{{asset('uploads/'.$editData->cer_6)}}" hrf="javascript:void(0)" style="color: white" class="btn btn-sm btn-primary doc-modal">Preview</a>
                <a href="{{asset('uploads/'.$editData->cer_6)}}" download class="btn btn-sm btn-primary">Download</a>
            </div>
        </div>
    </div>

    {{-- Two academic reference letters including the referees name,position, address, company email & phone number on the official letterhead. --}}
    <div class="col-lg-4" >
        <div class="card shadow-lg bg-white rounded">
            @if(verifyExtention(get_extension(asset('uploads/'.$editData->cer_7)))) 
                <img class="img-responsive" src="{{asset('uploads/'.$editData->cer_7)}}" width="100%" height="154px">
            @else
                <iframe src='https://docs.google.com/gview?url={{asset('uploads/'.$editData->cer_7)}}&embedded=true'></iframe>
            @endif
            <div class="card-footer">
                <p>Two academic ref....</p>
                <a data-url="{{asset('uploads/'.$editData->cer_7)}}" hrf="javascript:void(0)" style="color: white" class="btn btn-sm btn-primary doc-modal">Preview</a>
                <a href="{{asset('uploads/'.$editData->cer_7)}}" download class="btn btn-sm btn-primary">Download</a>
            </div>
        </div>
    </div>

    @if(isset($studentDocuments))
        @foreach ($studentDocuments as $studentDocument)
            <div class="col-lg-4" >
                <div class="card shadow-lg bg-white rounded">
                    @if(verifyExtention(get_extension(asset('uploads/'.$studentDocument->doc_path)))) 
                        <img class="img-responsive" src="{{asset('uploads/'.$studentDocument->doc_path)}}" width="100%" height="154px">
                    @else
                        <iframe src='https://docs.google.com/gview?url={{asset('uploads/'.$studentDocument->doc_path)}}&embedded=true'></iframe>
                    @endif
                    <div class="card-footer">
                        <p>@if(strlen($studentDocument->doc_name) > 20){{substr($studentDocument->doc_name, 0, 18) . '...'}}@else{{$studentDocument->doc_name}} @endif</p>
                        <a data-url="{{asset('uploads/'.$studentDocument->doc_path)}}" hrf="javascript:void(0)" style="color: white" class="btn btn-sm btn-primary doc-modal">Preview</a>
                        <a href="{{asset('uploads/'.$studentDocument->doc_path)}}" download class="btn btn-sm btn-primary">Download</a>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>

<div class="modal modals fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="doc-modal-body"></div>
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
        $(document).on('click','.doc-modal',function(){
            var doc_url = $(this).data('url');
            let extentionType = doc_url.split('.').pop()
            $('.doc-modal-body').html('');
            isImage(extentionType) ? 
            $('.doc-modal-body').html('<img src="'+doc_url+'" style="width:100%" >') :
            $('.doc-modal-body').html('<iframe src="https://docs.google.com/gview?url='+doc_url+'&embedded=true" style="width:100%;height:700px" > </iframe>')
            $('.modals').modal('show');
        });   
    });

    $(document).ready(function(){

     
       
        $(document).on('click','.submit-button',function(e){
          
            toastr.info("Please wait a minute.Thank you");
            e.preventDefault();
            student_id = $('#student_id').val();
            doc_name = $('input[name=doc_name]').val();
            doc_file = $('input[name=doc_file]')[0].files[0];
            var formData = new FormData();
            formData.append('doc_file',doc_file);
            formData.append('doc_name',doc_name);
            formData.append('student_id',student_id);
                 $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
               
            $.ajax({
                url: "{{url('/student_upload')}}",
                type: 'POST',
                data:formData,
                contentType: false,
                processData: false,
                success: function(res){
                    if(res.status == 'suceess'){
                        toastr.success(res.message);
                        $('.upload_document_modal').modal('hide');
                        // $('#document_uploa_form')[0].reset();
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
            var docViewer = `
            <div class="col-lg-4">
                <div class="card shadow-lg bg-white rounded">
                    ${getCardPreview}
                    <div class="card-footer">
                        <p>${res.data.doc_name}</p>
                        <a data-url="${doc_path}" hrf="javascript:void(0)" style="color: white" class="btn btn-sm btn-primary doc-modal">Preview</a>
                        <a href="${doc_path}" download class="btn btn-sm btn-primary">Download</a>
                    </div>
                </div>
            </div>
            `;
            $('.doc_div').append(docViewer);
        }
    });

  
</script>