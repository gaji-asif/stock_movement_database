<div class="table-responsive">

    <table class="datatable_custom_notes  table table-striped table-bordered dtb_custom_tbl_common text-center">
        <thead>
            <tr>
                <th width="5">#SL</th>
                <th  width="30" >Preview</th>
                <th width="20">Document Name</th>
                <th width="15" >File Name</th>
                <th width="10" >Date</th>
                <th width="10">Action</th>
            </tr>
        </thead>
        <tbody>

            @if(isset($studentCustomeNotes))
      
                @foreach ($studentCustomeNotes as $key=>$studentCustomeNote)
        
                    <tr>
                        <td class="text-center">{{++$key}}</td>
                        <td class="text-center">
                            @if(verifyExtention(get_extension(asset('uploads/'.$studentCustomeNote->doc_path)))) 
                                <img class="img-responsive" src="{{asset('uploads/'.$studentCustomeNote->doc_path)}}" width="100%" height="154px">
                            @else
                                <iframe src='https://docs.google.com/gview?url={{asset('uploads/'.$studentCustomeNote->doc_path)}}&embedded=true ' style="height:150px !important;width:150px !important"></iframe>
                            @endif
                        </td>
                        <td class="text-center">@if(isset($studentCustomeNote->facilityType)){{$studentCustomeNote->facilityType->type_name}}@endif</td>
                        <td class="text-center BreakWord">{{$studentCustomeNote->doc_path}}</td>
                        <td class="text-center">{{date('Y-m-d',strtotime($studentCustomeNote->date))}}</td>
                        <td class="text-center">
                            <a data-url="{{asset('uploads/'.$studentCustomeNote->doc_path)}}" hrf="javascript:void(0)" style="color: white" class="btn btn-sm m-1 btn-primary show-custome_note_doc_modal">Preview</a>
                            <button type="button" class="btn btn-sm btn-primary m-1 show-custome_note_modal" data-student_custome_note_id="{{$studentCustomeNote->id}}" >See Note</button>
                            <a href="{{asset('uploads/'.$studentCustomeNote->doc_path)}}" download class="btn btn-sm btn-primary m-1">Download</a>
    
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function(){
        $(".datatable_custom_notes").dataTable({
            order: [
                    [0, "desc"]
                ]
        });
    });
</script>