<div class="table-responsive">

    <table class="datatable_notes  table table-striped table-bordered dtb_custom_tbl_common text-center" >
        <thead>
            <tr>
                <th width="3">#SL</th>
                <th  width="10">Date Added</th>
                <th width="30">Preview</th>
                <th width="40">Notes</th>
                <th width="7" >Added By</th>
                @if(Session::get('role') == 0)
                    <th width="10">Action</th>
                @endif
               
            </tr>
        </thead>
        <tbody>

            @if(isset($studentNotes))
                @foreach ($studentNotes as $key=>$studentNote)
                    <tr>
                        <td>{{++$key}} </td>
                        <td>{{date('Y-m-d h:i A',strtotime($studentNote->created_at))}}</td>
                        <td class="text-center">
                            @if(verifyExtention(get_extension(asset('uploads/'.$studentNote->doc_path)))) 
                                <img class="img-responsive" src="{{asset('uploads/'.$studentNote->doc_path)}}" width="100%" height="154px">
                            @else
                                <iframe src='https://docs.google.com/gview?url={{asset('uploads/'.$studentNote->doc_path)}}&embedded=true ' style="height:120px !important;width:120px !important"></iframe>
                            @endif
                        </td>
                        <td>{!!$studentNote->notes!!}</td>
                        <td>@if(isset($studentNote->addedBy)){{$studentNote->addedBy->name}}@endif</td>  
                        <td>
                            <a data-url="{{asset('uploads/'.$studentNote->doc_path)}}" hrf="javascript:void(0)" style="color: white" class="btn btn-sm m-1 btn-primary show-notes_doc_modal">Preview</a>
                            @if(Session::get('role') == 0)
                                <a href="{{url('/show-delete-note/'.$studentNote->id)}}"  class="m-1 modalLink btn btn-sm btn-danger">Delete</a>
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
        $(".datatable_notes").dataTable();
    });
</script>
        
