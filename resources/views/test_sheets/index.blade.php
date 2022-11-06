@extends('master')
@section('mainContent')
<br><br>
<div class="row">
  <div class="col-lg-12" style="margin-bottom: 20px;">
 <a class="btn btn-info btn-sm pull-right" style="float: right;" href="{{route('testSheets.create', $id)}}">Add New Test Sheet</a>  
</div>
</div>
@foreach ($dtbTestSheets as $dtbTestSheet)

<div class="card">
 <div class="card-datatable table-responsive mb-0" style="padding: 14px 0px;">
  <div id="tickets-list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
    <div class="row">
      <div class="col-sm-12 col-lg-12" style="padding: 0px 0px !important;">

        <div class="nav-tabs-top nav-responsive-sm" style="padding:0px 14px 0px 14px;display: block;">
          <div class="">

            <div class="card-body" style="padding: 0px 4px;">
              <div class="card-datatable table-responsive" style="padding-top: 0px;padding-bottom: 0px">

                <div class="row">
                  <div class="col-md-12 col-xl-12">
                    <h4 class="card-title" style="padding-left: 0px;margin-left: -5px;font-weight: 600;margin-bottom: 13px;"><span style="font-size: 14px;font-weight: 500;float: left;margin-right: 6px;margin-top: 3px;color: #0000008a;">Test Sheet Name | </span> {{$dtbTestSheet->name}} 

                   

                       <a href="{{route('testCase.create', [$id, $dtbTestSheet->id])}}" class="btn btn-primary btn-sm pull-right dtb_custom_btn_default" style="margin-bottom: 20px;">Add New Test Case</a>
                     </h4>
                  </div>
                </div>

                <table class="table table-striped table-bordered issueofapptbl dtb_custom_tbl_common" style="margin-bottom: 0px" id="">
                  <thead>
                    <tr>
                     
                      <th width="140px">Function(Screen)</th>
                      <th width="140px">Function</th>
                      <th width="220px">Content</th>
                      <th width="300px">
                       <table class="table table-striped table-bordered issueofapptbl dtb_custom_tbl_common">
                        <tr>
                          <td style="border: none; border-top: none;">Staging</td>
                          <td></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>Result</td>
                          <td>Tested By</td>
                          <td>Date</td>
                        </tr>

                      </table>
                    </th>

                     <th width="300px">
                       <table class="table table-striped table-bordered issueofapptbl dtb_custom_tbl_common">
                        <tr>
                          <td style="border: none; border-top: none;">Production</td>
                          <td></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>Result</td>
                          <td>Tested By</td>
                          <td>Date</td>
                        </tr>

                      </table>
                    </th>
                    

                       <th width="50px;">Actions</th>
                  </tr>
                </thead>
                <tbody>

                      @php

                            
                              $testCases = \App\DtbTestCase::query()
                              ->from('dtb_test_cases as tc')
                              ->leftjoin('dtb_users as u','tc.staging_tested_by', '=', 'u.id')
                              ->leftjoin('dtb_users as uu','tc.production_tested_by', '=', 'uu.id')
                              ->where('tc.test_sheet_id', $dtbTestSheet->id) ->orderBy('tc.id','DESC')
                              ->get([ 'tc.*', 'uu.name as production_tested_user', 'u.name as staging_user_tested']);
                          @endphp

                          @foreach ($testCases as $testCase)
                                <tr>


                                  <td>{{ $testCase->test_case_title}}</td>
                                  <td>{{ $testCase->test_case_title}}</td>
                              
                                  <td>{{htmlspecialchars($testCase->detail)}}</td>

                                   <td>
                                     <table class="table table-striped table-bordered issueofapptbl dtb_custom_tbl_common" style="margin-bottom: 0px" id="">
                                    
                                        <tr>
                                          @if(!empty($testCase->staging_tested_result))
                                           <td>{{$testCase->staging_tested_result}}</td>
                                          @endif

                                          @if(!empty($testCase->staging_user_tested))
                                           <td>{{$testCase->staging_user_tested}}</td>
                                          @endif

                                           @if(!empty($testCase->staging_tested_date))
                                           <td>{{$testCase->staging_tested_date}}</td>
                                          @endif

                                         
                                        
                                        </tr>
                                     
                                     </table>
                                   </td>
                                    <td>
                                     <table class="table table-striped table-bordered issueofapptbl dtb_custom_tbl_common" style="margin-bottom: 0px" id="">

                                        <tr>
                                          @if(!empty($testCase->production_tested_result))
                                           <td>{{$testCase->production_tested_result}}</td>
                                          @endif

                                          @if(!empty($testCase->production_tested_user))
                                           <td>{{$testCase->production_tested_user}}</td>
                                          @endif

                                           @if(!empty($testCase->production_tested_date))
                                           <td>{{$testCase->production_tested_date}}</td>
                                          @endif

                                         
                                        
                                        </tr>
                                    
                                        
                                     
                                     </table>
                                   </td>

                                   <td></td>



                                </tr>
                            @endforeach

                </tbody>
              </table>

            </div>
          </div>


        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<br>
@endforeach

<!-- Modal template -->
{{-- <div class="modal fade" id="memoModal">
  <div class="modal-dialog modal-lg">
    <form method="POST" class="modal-content" id="memoUpdate">

      <div class="modal-header">
        <h5 class="modal-title">
          Memo of App :<span id ="appNameSpanID"></span> 
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

        <input type="hidden" name='memo_app_id' id ='memo_app_id' value=''>

        <div class="form-group">
          <div id="editSection"></div>
          <textarea id="content2bSavedHolder" name="memo_text" style="display:none"></textarea>
        </div>

        <div class="modal-footer">
          <button id="feedbackclosebtn" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary updatMemobtn" data-dismiss="modal">Save</button>
        </div>
      </form>
    </div>
  </div> --}}









  <style>

    .nav-tabs a.nav-link.active {
      background: #26b4ff0f !IMPORTANT;
      border-radius: 0px;
      border-bottom: 0px !important;
    }
    .nav-tabs a.nav-link {
      border: 1px solid rgba(24, 28, 33, 0.06) !important;
      border-radius: 0px !important;
      margin-right: -1px !important;
      padding: 4px 8px;
      background: #a9a9a914;
    }
    .apptitle {
      font-size: 12px;
      padding: 1px 5px 0px 13px;
      text-align: center;
      color: white;
    }
    .memobtn {
      padding: 0;
      background: transparent;
      border: 0px;
      display: inline-flex;
      float: right;
      margin-left: 11px;
    }

    span.apptitle span {
      /*    border: 1px solid #26b4ff66;*/
  /*  padding: 4px 26px;
    margin-left: -2px;
    text-align: left;*/
  }
  span.progresstd {
    background: green;
    padding: 3px 18px;
    height: 22px;
    /* width: 53px; */
    text-align: right;
    content: "";
    display: block;
    /* float: right; */
    text-align: center;
  }
  .appissueholder i{
    margin-top: -8px;
    margin-right: -1px;
  }

 /* .customicons{
    background-image: url('{{ URL::asset('assets_/img/customicons.png')}}')
 }*/

 .totalprojecticon{ background-image: url('{{ URL::asset('assets_/img/totalproject.png')}}');}

 .totalappicon{background-image: url('{{ URL::asset('assets_/img/totalappicon.png')}}');}

 .totalaprojectissues{background-image: url('{{ URL::asset('assets_/img/projectissues.png')}}');}

 .totalengagedev{background-image: url('{{ URL::asset('assets_/img/engagedev.png')}}');}

 .manageprojecticons {
  height: 61px;
  width: 48px;
  margin-top: -5px;
  background-repeat: no-repeat;
  background-size: contain;
}

.appsmallicon {
  height: 22px;

  background-image: url('{{ URL::asset('assets_/img/applogosmall.png')}}');
  width: 20px;
  display: block;
  background-repeat: no-repeat;
}
.memosmallicon {
  height: 22px;
  background-image: url('{{ URL::asset('assets_/img/memoiconsmall.png')}}');
  width: 20px;
  display: block;
  margin-top: 2px;
  background-repeat: no-repeat;
}

.dataTables_wrapper .dataTables_length {
  margin-left: -12px;
}


.btn-circle {
  width: 30px;
  height: 30px;
  text-align: center;
  padding: 6px 0;
  font-size: 12px;
  line-height: 1.428571429;
  border-radius: 15px;
}
.btn-circle.btn-lg {
  width: 50px;
  height: 50px;
  padding: 10px 16px;
  font-size: 18px;
  line-height: 1.33;
  border-radius: 25px;
}
.btn-circle.btn-xl {
  width: 120px;
  height: 30px;
  padding: 10px 16px;
  font-size: 10px;
  line-height: 1.33;
  border-radius: 35px;
}

.pull-right{
  font-size: 15px;

}
.dataTables_wrapper .dataTables_length {
  margin-left: -23px;
}
div.dataTables_wrapper .dataTables_filter {
  margin-right: -23px;
}
.dataTables_info {
  display: none !important;
}
.dataTables_paginate .pagination {
  margin-right: -23px !important;
}

.issueofapptbl{
  margin: 0 auto;
  width: 100%;
  clear: both;
  border-collapse: collapse;
  table-layout: fixed; 
  word-wrap:break-word;
}
.dtb_custom_tbl_common tbody tr td {
  padding: 0px 4px 0px 6px;
  vertical-align: middle;
  font-size: 14px;
}
</style>
<script src="{{asset('/assets/js/showdown.min.js')}}"></script>

<link rel="stylesheet" href="{{asset('css/for_marked/bootstrap-markdown.min.css')}}" />
<link rel="stylesheet" href="{{asset('css/for_marked/style.css')}}" />
<link rel="stylesheet" href="{{asset('css/for_marked/codemirror.css')}}" />
<link rel="stylesheet" href="{{asset('css/for_marked/github.min.css')}}" />
<link rel="stylesheet" href="{{asset('tui-editor/css/tui-editor.css')}}" />
<link rel="stylesheet" href="{{asset('tui-editor/css/tui-editor-contents.css')}}" />

<!-- <link rel="stylesheet" href="https://uicdn.toast.com/tui-editor/latest/tui-editor.css"></link> -->
<!-- <link rel="stylesheet" href="https://uicdn.toast.com/tui-editor/latest/tui-editor-contents.css"></link> -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.33.0/codemirror.css"></link> -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/github.min.css"></link> -->
<script src="{{asset('js/for_marked/tui-editor-Editor-full.js')}}"></script>
{{--   <script type="text/javascript">
// 

function popup(memoAppId,memoNmae){
  document.getElementById("memo_app_id").value=memoAppId;
//  $("#appNameSpanID").innerText= memoNmae;
document.getElementById("appNameSpanID").innerHTML=memoNmae;
//  alert(memoNmae);
var text = document.getElementById("memo_"+memoAppId).value,
target = document.getElementById('editSection'),
converter = new showdown.Converter(),
html = converter.makeHtml(text);
target.innerHTML = html;

var initcontent = [].join('\n');
editor = new tui.Editor({
  el: document.querySelector('#editSection'),
  initialEditType: 'markdown',    
  height: '300px',
  previewStyle: 'vertical',
  initialValue: text,
  exts: [
  {
    name: 'chart',
    minWidth: 100,
    maxWidth: 600,
    minHeight: 100,
    maxHeight: 300
  },
  'scrollSync',
  'colorSyntax',
  'uml',
  'mark',
  'table'
  ],
  hooks: {
    addImageBlobHook: function (blob, callback) {
      var myupload = ImageUpload(blob);
                //console.log(blob);
                var cllbackimg = myupload;
                //var cllbackimg = document.location.origin +'/developmentmanage/public/'+myupload;
                callback(cllbackimg, 'alt text');
              }
            }
          });


}
//
</script> --}}



{{--     <script type="text/javascript">

  var initcontent = [].join('\n');
  var editor = new tui.Editor({
    el: document.querySelector('#editSection'),
    height: '400px',
    previewStyle: 'vertical',
    initialValue: initcontent,
    exts: [
    {
      name: 'chart',
      minWidth: 100,
      maxWidth: 600,
      minHeight: 100,
      maxHeight: 300
    },
    'scrollSync',
    'colorSyntax',
    'uml',
    'mark',
    'table'
    ],
    hooks: {
      addImageBlobHook: function (blob, callback) {
        var myupload = ImageUpload(blob);
                      //console.log(blob);
                      var cllbackimg = myupload;
                      //var cllbackimg = document.location.origin +'/developmentmanage/public/'+myupload;
                      callback(cllbackimg, 'alt text');
                    }
                  }
                });

  function ImageUpload(images){

    var myresult = "";
    var dataimg = new FormData();
    var form = dataimg.append('file', images);

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      url : '{{ url('/uploadappfiles') }}',
      method: 'POST',
      async: false,
      cache : false,
      contentType : false,
      processData : false,
      data :  dataimg,
      success: function (response) {
                  //alert(response);
                  //console.log(response);
                  myresult = response;
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                  alert('error in uploading file');
                }
              });

    return myresult;
  }


</script> --}}


<script>

// $('body').on('click','.updatMemobtn',function(e){
//     e.preventDefault();



//     $.ajaxSetup({
//                 headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                 }
//                 });
//     var appid = $('#memo_app_id').val();
//     var content2bSaved = editor.getValue(); 
//     //var content2bSaved = editor.getHtml();
//     $('#content2bSavedHolder').html(content2bSaved);

//     $.ajax({
//            url: '/apps/updatememo/'+appid,
//            type: 'POST',
//            data: {
//              memo:$('#content2bSavedHolder').val()
//            },
//            success: function(response){
//             alert(response);
//             $('#memo_'+appid).html(content2bSaved);
//            },
//            error: function (XMLHttpRequest, textStatus, errorThrown) {
//                alert('error in uploading file');
//            }
//     });




// });


$(document).ready(function() {

  $('.issueofapptbl').DataTable( {
    "paging":   false,
    "ordering": false,
    "info":     false,
    "searching": false
  } );

    // $('.issueofapptbl').DataTable();
  } );


$('.select_all').on('click',function(){
  $('.checkbox').each(function(){
    this.checked = false;
  });

  var project_id = $(this).attr('project_id');
  $('.checkbox_'+project_id).each(function(){
    this.checked = true;
  });
});

$('.clear_all').on('click',function(){
 var project_id = $(this).attr('project_id');
 $('.checkbox_'+project_id).each(function(){
  this.checked = false;
});
});
</script>
@endsection
