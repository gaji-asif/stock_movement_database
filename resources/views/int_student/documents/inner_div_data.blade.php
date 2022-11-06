<div class="table-responsive">
@php
 $index = 1;   
@endphp
    <table class="datatable_document  table table-striped table-bordered dtb_custom_tbl_common text-center">
        <thead>
            <tr>
                <th width="5">#SL</th>
                <th width="30">Preview</th>
                <th width="20">Document Name</th>
                <th width="25" >File Name</th>
                <th width="10">Action</th>
            </tr>
        </thead>
        <tbody>
  
      
        @if(!is_null($editData->cv))
            <tr>
            
                <td class="text-center">{{$index++}}</td>
                <td class="text-center">
                        @if(verifyExtention(get_extension(asset($editData->cv)))) 
                            <img class="img-responsive" src="{{asset($editData->cv)}}" width="100%" height="154px">
                        @else
                            <iframe src='https://docs.google.com/gview?url={{asset($editData->cv)}}&embedded=true ' style="height:150px !important;width:150px !important"></iframe>
                        @endif
                </td>
                <td class="text-center BreakWord">Cv</td>
                <td class="text-center BreakWord">{{$editData->cv}}</td>
                <td class="text-center">
                    <a data-url="{{asset($editData->cv)}}" hrf="javascript:void(0)" style="color: white" class="btn m-1 btn-sm btn-primary doc-modal">Preview</a>
                    <a href="{{asset($editData->cv)}}" download class="btn btn-sm m-1 btn-primary">Download</a>
                    @if(Session::get('role') == 0)
                        <a href="{{url('/show-delete-document/'.$editData->id.'/1')}}"  class="m-1 modalLink btn btn-sm btn-danger">Delete</a>
                    @endif
                </td>
            </tr>
        @endif
        @if(!is_null($editData->cp_passport))
            <tr>
                <td class="text-center">{{$index++}}</td>
                <td class="text-center">
                        @if(verifyExtention(get_extension(asset($editData->cp_passport)))) 
                            <img class="img-responsive" src="{{asset($editData->cp_passport)}}" width="100%" height="154px">
                        @else
                            <iframe src='https://docs.google.com/gview?url={{asset($editData->cp_passport)}}&embedded=true ' style="height:150px !important;width:150px !important"></iframe>
                        @endif
                </td>
                <td class="text-center BreakWord">Copy of passport </td>
                <td class="text-center BreakWord">{{$editData->cp_passport}}</td>
                <td class="text-center">
                    <a data-url="{{asset($editData->cp_passport)}}" hrf="javascript:void(0)" style="color: white" class="btn m-1 btn-sm btn-primary doc-modal">Preview</a>
                    <a href="{{asset($editData->cp_passport)}}" download class="btn btn-sm btn-primary">Download</a>
                    @if(Session::get('role') == 0)
                        <a href="{{url('/show-delete-document/'.$editData->id.'/2')}}"  class="m-1 modalLink btn btn-sm btn-danger">Delete</a>
                    @endif    
                </td>
            </tr>
        @endif
        @if(!is_null($editData->cer_1))
            <tr>
                <td class="text-center">{{$index++}}</td>
                <td class="text-center">
                        @if(verifyExtention(get_extension(asset($editData->cer_1)))) 
                            <img class="img-responsive" src="{{asset($editData->cer_1)}}" width="100%" height="154px">
                        @else
                            <iframe src='https://docs.google.com/gview?url={{asset($editData->cer_1)}}&embedded=true ' style="height:150px !important;width:150px !important"></iframe>
                        @endif
                </td>
                <td class="text-center BreakWord">SSC/O Levels certificate & Transcript </td>
                <td class="text-center BreakWord">{{$editData->cer_1}}</td>
                <td class="text-center">
                    <a data-url="{{asset($editData->cer_1)}}" hrf="javascript:void(0)" style="color: white" class="btn m-1 btn-sm btn-primary doc-modal">Preview</a>
                    <a href="{{asset($editData->cer_1)}}" download class="btn btn-sm btn-primary">Download</a>
                    @if(Session::get('role') == 0)
                        <a href="{{url('/show-delete-document/'.$editData->id.'/3')}}"  class="m-1 modalLink btn btn-sm btn-danger">Delete</a>
                    @endif     
                </td>
            </tr>
        @endif  
        @if(!is_null($editData->cer_2))
            <tr>
                <td class="text-center">{{$index++}}</td>
                <td class="text-center">
                        @if(verifyExtention(get_extension(asset($editData->cer_2)))) 
                            <img class="img-responsive" src="{{asset($editData->cer_2)}}" width="100%" height="154px">
                        @else
                            <iframe src='https://docs.google.com/gview?url={{asset($editData->cer_2)}}&embedded=true ' style="height:150px !important;width:150px !important"></iframe>
                        @endif
                </td>
                <td class="text-center BreakWord">HSC/A Levels certificate & Transcript</td>
                <td class="text-center BreakWord">{{$editData->cer_2}}</td>
                <td class="text-center">
                    <a data-url="{{asset($editData->cer_2)}}" hrf="javascript:void(0)" style="color: white" class="btn btn-sm m-1 btn-primary doc-modal">Preview</a>
                    <a href="{{asset($editData->cer_2)}}" download class="btn btn-sm btn-primary">Download</a>
                    @if(Session::get('role') == 0)
                        <a href="{{url('/show-delete-document/'.$editData->id.'/4')}}"  class="m-1 modalLink btn btn-sm btn-danger">Delete</a>
                    @endif       
                </td>
            </tr>
        @endif 
        @if(!is_null($editData->cer_3))
            <tr>
                <td class="text-center">{{$index++}}</td>
                <td class="text-center">
                        @if(verifyExtention(get_extension(asset($editData->cer_3)))) 
                            <img class="img-responsive" src="{{asset($editData->cer_3)}}" width="100%" height="154px">
                        @else
                            <iframe src='https://docs.google.com/gview?url={{asset($editData->cer_3)}}&embedded=true ' style="height:150px !important;width:150px !important"></iframe>
                        @endif
                </td>
                <td class="text-center BreakWord">Bachelor degree certificate & Transcript For Master Application</td>
                <td class="text-center BreakWord">{{$editData->cer_3}}</td>
                <td class="text-center">
                    <a data-url="{{asset($editData->cer_3)}}" hrf="javascript:void(0)" style="color: white" class="btn btn-sm m-1 btn-primary doc-modal">Preview</a>
                    <a href="{{asset($editData->cer_3)}}" download class="btn btn-sm btn-primary">Download</a>
                    @if(Session::get('role') == 0)
                        <a href="{{url('/show-delete-document/'.$editData->id.'/5')}}"  class="m-1 modalLink btn btn-sm btn-danger">Delete</a>
                    @endif    
                </td>
            </tr>
        @endif  

    @if(!is_null($editData->cer_4))
        <tr>
            <td class="text-center">{{$index++}}</td>
            <td class="text-center">
                    @if(verifyExtention(get_extension(asset($editData->cer_4)))) 
                        <img class="img-responsive" src="{{asset($editData->cer_4)}}" width="100%" height="154px">
                    @else
                        <iframe src='https://docs.google.com/gview?url={{asset($editData->cer_4)}}&embedded=true ' style="height:150px !important;width:150px !important"></iframe>
                    @endif
            </td>
            <td class="text-center BreakWord">IELTS/ TOEFL/ Other</td>
            <td class="text-center BreakWord">{{$editData->cer_4}}</td>
            <td class="text-center">
                <a data-url="{{asset($editData->cer_4)}}" hrf="javascript:void(0)" style="color: white" class="btn btn-sm m-1 btn-primary doc-modal">Preview</a>
                <a href="{{asset($editData->cer_4)}}" download class="btn btn-sm btn-primary">Download</a>
                @if(Session::get('role') == 0)
                    <a href="{{url('/show-delete-document/'.$editData->id.'/6')}}"  class="m-1 modalLink btn btn-sm btn-danger">Delete</a>
                @endif    
            </td>
        </tr>
    @endif  
    @if(!is_null($editData->cer_5))
        <tr>
            <td class="text-center">{{$index++}}</td>
            <td class="text-center">
                    @if(verifyExtention(get_extension(asset($editData->cer_5)))) 
                        <img class="img-responsive" src="{{asset($editData->cer_5)}}" width="100%" height="154px">
                    @else
                        <iframe src='https://docs.google.com/gview?url={{asset($editData->cer_5)}}&embedded=true ' style="height:150px !important;width:150px !important"></iframe>
                    @endif
            </td>
            <td class="text-center BreakWord">Personal Statement</td>
            <td class="text-center BreakWord">{{$editData->cer_5}}</td>
            <td class="text-center">
                <a data-url="{{asset($editData->cer_5)}}" hrf="javascript:void(0)" style="color: white" class="btn btn-sm m-1 btn-primary doc-modal">Preview</a>
                <a href="{{asset($editData->cer_5)}}" download class="btn btn-sm btn-primary">Download</a>
                @if(Session::get('role') == 0)
                    <a href="{{url('/show-delete-document/'.$editData->id.'/7')}}"  class="m-1 modalLink btn btn-sm btn-danger">Delete</a>
                @endif     
            </td>
        </tr>
    @endif  
    @if(!is_null($editData->cer_6))
        <tr>
            <td class="text-center">{{$index++}}</td>
            <td class="text-center">
                    @if(verifyExtention(get_extension(asset($editData->cer_6)))) 
                        <img class="img-responsive" src="{{asset($editData->cer_6)}}" width="100%" height="154px">
                    @else
                        <iframe src='https://docs.google.com/gview?url={{asset($editData->cer_6)}}&embedded=true ' style="height:150px !important;width:150px !important"></iframe>
                    @endif
            </td>
            <td class="text-center BreakWord">Job reference letter if there is any study gap upto 3 years</td>
            <td class="text-center BreakWord">{{$editData->cer_6}}</td>
            <td class="text-center">
                <a data-url="{{asset($editData->cer_6)}}" hrf="javascript:void(0)" style="color: white" class="btn btn-sm m-1 btn-primary doc-modal">Preview</a>
                <a href="{{asset($editData->cer_6)}}" download class="btn btn-sm btn-primary">Download</a>
                @if(Session::get('role') == 0)
                    <a href="{{url('/show-delete-document/'.$editData->id.'/8')}}"  class="m-1 modalLink btn btn-sm btn-danger">Delete</a>
                @endif       
            </td>
        </tr>
    @endif

    @if(!is_null($editData->cer_7))
        <tr>
            <td class="text-center">{{$index++}}</td>
            <td class="text-center">
                    @if(verifyExtention(get_extension(asset($editData->cer_7)))) 
                        <img class="img-responsive" src="{{asset($editData->cer_7)}}" width="100%" height="154px">
                    @else
                        <iframe src='https://docs.google.com/gview?url={{asset($editData->cer_7)}}&embedded=true ' style="height:150px !important;width:150px !important"></iframe>
                    @endif
            </td>
            <td class="text-center BreakWord">Two academic reference letters including the referees name,position, address, company email & phone number on the official letterhead</td>
            <td class="text-center BreakWord">{{$editData->cer_7}}</td>
            <td class="text-center">
                <a data-url="{{asset($editData->cer_7)}}" hrf="javascript:void(0)" style="color: white" class="btn btn-sm btn-primary m-1 doc-modal">Preview</a>
                <a href="{{asset($editData->cer_7)}}" download class="btn btn-sm btn-primary">Download</a>
                @if(Session::get('role') == 0)
                    <a href="{{url('/show-delete-document/'.$editData->id.'/9')}}"  class="m-1 modalLink btn btn-sm btn-danger">Delete</a>
                @endif       
            </td>
        </tr>
    @endif
    @if(isset($studentDocuments))
      
    @foreach ($studentDocuments as $key=>$studentDocument)

        <tr>
            <td class="text-center">{{$key+$index}}</td>
            <td class="text-center">
                @if(verifyExtention(get_extension(asset('uploads/'.$studentDocument->doc_path)))) 
                    <img class="img-responsive" src="{{asset('uploads/'.$studentDocument->doc_path)}}" width="100%" height="154px">
                @else
                    <iframe src='https://docs.google.com/gview?url={{asset('uploads/'.$studentDocument->doc_path)}}&embedded=true ' style="height:150px !important;width:150px !important"></iframe>
                @endif
            </td>
            <td class="text-center BreakWord">{{$studentDocument->doc_name}}</td>
            <td class="text-center BreakWord">{{$studentDocument->doc_path}}</td>
            <td class="text-center">
                <a data-url="{{asset('uploads/'.$studentDocument->doc_path)}}" hrf="javascript:void(0)" style="color: white" class="btn btn-sm m-1 btn-primary doc-modal">Preview</a>
                <a href="{{asset('uploads/'.$studentDocument->doc_path)}}" download class="btn btn-sm btn-primary">Download</a>
                @if(Session::get('role') == 0)
                    <a href="{{url('/show-delete-document/'.$editData->id.'/0')}}"  class="m-1 modalLink btn btn-sm btn-danger">Delete</a>
                @endif       
            </td>
        </tr>
    @endforeach
    @endif

</tbody>
</table>

</div>

<script>
    $(document).ready(function(){
        $(".datatable_document").dataTable({
            order: [
                    [0, "asc"]
                ]
        });
    });
</script>
