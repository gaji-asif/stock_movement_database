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
    {{-- <div class="table-responsive">

        <table class="datatable_document  table table-striped table-bordered dtb_custom_tbl_common text-center">
            <thead>
                <tr>
                    <th>#SL</th>
                    <th >Preview</th>
                    <th >Document Name</th>
                    <th >File Name</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody> --}}
        <div id="document_inner_data">
            @include('int_student.documents.inner_div_data')
        </div>
      
{{-- </tbody>
</table>

</div> --}}

{{-- <script>
    $(document).ready(function(){
        $(".datatable_document").dataTable({
            order: [
                    [0, "desc"]
                ]
        });
    });
</script>           --}}
   
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

     
       
        $(document).on('click','.document_delete',function(e){
          
            e.preventDefault();
            student_id = $('#student_id').val();
            delete_document_for = $('input[name=delete_document_for]').val();
            delete_document_id = $('input[name=delete_document_id]').val();
       
            var formData = new FormData();
            formData.append('document_for',delete_document_for);
            formData.append('id',delete_document_id);
                 $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
               
            $.ajax({
                url: "{{url('/delete-document')}}",
                type: 'POST',
                data:formData,
                contentType: false,
                processData: false,
                success: function(res){
                    if(res){
                        toastr.success("Student Document Deleted Successfully");  
                        $("#showDetaildModal").modal('hide');
                        $('#document_inner_data').html('');
                        $('#document_inner_data').html(res);                  
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
                    if(res){
                        toastr.success('Student Document Uploaded Successfully');
                        $('.upload_document_modal').modal('hide');
                        // $('#document_uploa_form')[0].reset();
                   
                        $('#document_inner_data').html('');
                        $('#document_inner_data').html(res);
                        // console.log( $('#document_inner_data'));

                        
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