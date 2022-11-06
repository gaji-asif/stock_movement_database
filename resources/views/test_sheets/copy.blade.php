@extends('master')
@section('mainContent')
<style type="text/css">
  .issue_wrapper{
    margin:0 auto;
  }
  .gap{
    padding: 0px 50px 0px 50px;
  }
  .te-preview {
    background: white;
}
#tickets-list{
  width: 100%;
}
</style>

<div class="row mt-2">
  <div class="col-lg-10 issue_wrapper">

    <div class="mb-4">
      <div class="card-body gap">


      <h4 class="mt-4 mb-4" style="background: transparent;">
 <!--
      <span style="float: left;">  asdasd </span> -->




      <a href="{{route('testSheets.index', $id)}}" class="btn btn-primary btn-sm pull-right dtb_custom_btn_default">All Test Sheets</a>
      </h4>
      <div style="clear: both"></div>
    <!--   <hr style="background: #0000000d;"> -->


        <div class="form-group row">
          <div class="col-sm-12">
            @if(session()->has('message'))
            <br>
            <div class="alert alert-success mb-10 background-success" role="alert">
              {{ session()->get('message') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif
          </div>
        </div>

    {!! Form::open(['route' => ['sheetcopystore', $id, $editData->id],'id' => 'copysheetform',])!!}
         {{ method_field('POST') }}

        <input type="hidden" name="project_id" value="<?php echo $editData->project_id; ?>">
        <input type="hidden" name="sheetid" value="<?php echo $editData->id; ?>">

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
             <label class="col-form-label text-sm-right">Name</label>
             <div class="">
              <input name="name" type="text" class="form-control mb-0  {{ $errors->has('name') ? ' is-invalid' : '' }}"  value="{{ old('name') ?? $editData->name }}">

              @if ($errors->has('name'))
              <span class="invalid-feedback" role="alert">
                <span class="messages"><strong>{{ $errors->first('name') }}</strong></span>
              </span>
              @endif
            </div>

            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="col-form-label text-sm-right">App</label>
                 <div class="">
                  <select name="app_id" class="custom-select NoborderRadius" id="app_id" style="height: 40px;">
                <option value="">Select App</option>
                  @foreach($apps as $app)
                  <option value="{{ old('app_id') ?? $app->id }}" {{ old('app_id') == $app->id ? 'selected="selected"' : '' }} <?php if($app->id == $editData->app_id){echo "selected";} ?>>{{ $app->app_name }}</option>
                  @endforeach
                </select>
                </div>
          </div>
        </div>

           <div class="col-md-4">
            <div class="form-group">
              <label class="col-form-label text-sm-right">Versions</label>
                 <div class="">
                  <select name="version_id" class="custom-select NoborderRadius" id="version_id" style="height: 40px;">
                <option value="">Select versions</option>
                  @foreach($versions as $version)
                  <option value="{{ old('version_id') ?? $version->id }}" {{ old('version_id') == $version->id ? 'selected="selected"' : '' }} <?php if($version->id == $editData->version_id){echo "selected";} ?>>{{ $version->version_name }}</option>
                  @endforeach
                </select>
                </div>
          </div>
        </div>

      </div>

      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label class="col-form-label text-sm-right">Start Date</label>
            <div class="">
              <input type="text" data-date="" data-date-format="YYY MMMM DD" name="start_date" id="start_date" class="controls input-append date form_datetime form-control {{ $errors->has('start_date') ? ' is-invalid' : '' }}" placeholder="start date" value="{{ old('start_date',isset($editData) && $editData?date( 'Y-m-d',strtotime($editData->start_date)):date( 'Y/m/d',strtotime(now()))) }}">
              @if ($errors->has('start_date'))
              <span class="invalid-feedback" role="alert">
                <span class="messages"><strong>{{ $errors->first('start_date') }}</strong></span>
              </span>
              @endif
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <label class="col-form-label text-sm-right">Scheduled End Date</label>
            <div class="">
              <input type="text" data-date="" data-date-format="YYY MMMM DD" name="schedules_end_date" id="schedules_end_date" class="controls input-append date form_datetime form-control {{ $errors->has('schedules_end_date') ? ' is-invalid' : '' }}" placeholder="End date"
              value="{{ old('schedules_end_date',isset($editData) && $editData?date( 'Y-m-d',strtotime($editData->schedules_end_date)):date( 'Y/m/d',strtotime(now()))) }}">

              @if ($errors->has('schedules_end_date'))
              <span class="invalid-feedback" role="alert">
                <span class="messages"><strong>{{ $errors->first('schedules_end_date') }}</strong></span>
              </span>
              @endif
            </div>
          </div>
        </div>
      </div>

      <div class="row">
          <div class="col-md-12">
            <div class="form-group">
             <label class="col-form-label text-sm-right">Detail</label>
             <div class="">

                <div id="editSection"></div>

              <textarea id="content2bSavedHolder" name="detail" class="form-control  {{ $errors->has('detail') ? ' is-invalid' : '' }}" style="display: none;"></textarea>

              @if ($errors->has('detail'))
              <span class="invalid-feedback" role="alert">
                <span class="messages"><strong>The detail field is required</strong></span>
              </span>
              @endif
            </div>
          </div>
        </div>
      </div>



  <div class="form-group row">
    <div class="col-md-8 ml-sm-auto">
      <button type="submit" class="btn btn-success dtb_custom_btn_default mt-4" style="padding: 5px 111px">Submit</button>
    </div>

  <!--   <div class="col-md-4 ml-sm-auto text-right">
      <a href="#" class="btn  btn-success dtb_custom_btn_default mt-4" title="Remove" data-toggle="modal" data-target="#appdeletedmodal" style="padding: 4px 19px;font-size: 14px;color:red;border-color: red">Delete</a>
    </div> -->
  </div>
</form>
</div>
</div>
</div>
</div>

  <!-- <div class="container">
        <div class="row">
          <div class="col-lg-12">
             <h4 class="px-0" style="color: black">
        All Test Cases
         <a href="{{route('testCase.create', [$id,$editData->id])}}" class="btn btn-primary btn-sm pull-right dtb_custom_btn_default" style="margin-bottom: 20px;">Add New Test Case</a>
    </h4>


            <div class="table-responsive" style="width: 100%;">

               <table id="tickets-list" class="datatables-demo table table-striped table-bordered dataTable no-footer dtb_custom_tbl_common" role="grid" aria-describedby="tickets-list_info" style="width: 1300px;">
               <thead>
                     <tr role="row">

                        <th>Test Case Title</th>
                        <th>Status</th>
                        <th>Importance</th>
                        <th>Priority</th>
                        <th>Result</th>
                        <th>test_type</th>

                     </tr>
                  </thead>

                  <tbody id="apptrdragable">


                    @php $sl = 1; @endphp
                    @foreach($allTestCases as $allTestCase)

                         <tr role="row" class="odd row1" data-id="{{ $allTestCase->id }}" id="{{$allTestCase->id}}">


                            <td class="py-0">
                               <div class="ticket-priority btn-group">

                                  <a href="#">{{$allTestCase->test_case_title}}</a>
                               </div>
                            </td>

                            <td class="py-0">
                               <div class="ticket-priority btn-group">

                                  <a href="#">
                                    @if($allTestCase->status == '1')
                                    active
                                    @elseif($allTestCase->status == '2')
                                    draft
                                    @else
                                    deprecated
                                    @endif

                                    </a>
                               </div>
                            </td>

                            <td class="py-0">
                               <div class="ticket-priority btn-group">

                                  <a href="#">
                                    @if($allTestCase->importance == '1')
                                    L1
                                    @elseif($allTestCase->importance == '2')
                                    L2
                                    @elseif($allTestCase->importance == '3')
                                    L3
                                    @elseif($allTestCase->importance == '4')
                                    L4
                                    @else
                                    L5



                                    @endif
                                  </a>
                               </div>
                            </td>
                            <td class="py-0">
                               <div class="ticket-priority btn-group">

                                  <a href="#">{{$allTestCase->priority}}</a>
                               </div>
                            </td>
                            <td class="py-0">
                               <div class="ticket-priority btn-group">

                                  <a href="#">
                                    @if($allTestCase->result == '0')
                                    none
                                    @elseif($allTestCase->result == '1')
                                    pass
                                    @elseif($allTestCase->result == '2')
                                    blocked
                                    @elseif($allTestCase->result == '3')
                                    Retest
                                    @else
                                    Failed



                                    @endif
                                  </a>
                               </div>
                            </td>
                            <td class="py-0">
                               <div class="ticket-priority btn-group">

                                  <a href="#">

                                    @if($allTestCase->test_type == '0')
                                    Other Test
                                    @elseif($allTestCase->test_type == '1')
                                    Functional test
                                    @elseif($allTestCase->test_type == '2')
                                    Smoke test
                                    @elseif($allTestCase->test_type == '3')
                                    Regressive test
                                    @elseif($allTestCase->test_type == '4')
                                    Security test
                                    @elseif($allTestCase->test_type == '5')
                                    Usability test
                                    @elseif($allTestCase->test_type == '6')
                                    Performance test
                                    @elseif($allTestCase->test_type == '7')
                                    Acceptance test
                                    @else
                                    Failed
                                    @endif

                                  </a>
                               </div>
                            </td>



                         </tr>

                    @endforeach
                  </tbody>
               </table>
            </div>
          </div>
        </div>
</div> -->




  <!-- Modal -->
  <div class="modal fade" id="appdeletedmodal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color: #f8d7da;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h6 class="modal-title">Are you sure to delete?</h6>
        </div>
<!--         <div class="modal-body">
          <p>Some text in the modal.</p>
        </div> -->
        <div class="modal-footer">

            <button type="button" class="btn btn-primary" data-dismiss="modal">CANCEL</button>
          <button  value="{{ $editData->id ?? '' }}" type="button" class="btn btn-danger appdelbtn" data-dismiss="modal" data="{{ $editData->id }}" >YES</button>

        </div>
      </div>

    </div>
  </div>



      <textarea id="appmemo" rows="10" cols="82" style="display: none;"><?php if (!empty($editData&&!empty($editData->detail))) { echo $editData->detail;} else { echo ' *** '; } ?>
      </textarea>


  <script src="{{asset('/assets/js/showdown.min.js')}}"></script>
<!--   <link rel="stylesheet" href="https://uicdn.toast.com/tui-editor/latest/tui-editor.css"></link> -->
<!--   <link rel="stylesheet" href="https://uicdn.toast.com/tui-editor/latest/tui-editor-contents.css"></link> -->
<!--   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.33.0/codemirror.css"></link> -->
<!--   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/github.min.css"></link> -->
<!--   <script src="https://uicdn.toast.com/tui-editor/latest/tui-editor-Editor-full.js"></script> -->
<link rel="stylesheet" href="{{asset('css/for_marked/codemirror.css')}}" />
<link rel="stylesheet" href="{{asset('css/for_marked/github.min.css')}}" />
<link rel="stylesheet" href="{{asset('tui-editor/css/tui-editor.css')}}" />
<link rel="stylesheet" href="{{asset('tui-editor/css/tui-editor-contents.css')}}" />
<script src="{{asset('js/for_marked/tui-editor-Editor-full.js')}}"></script>

  <script type="text/javascript">
// window.onload = function(){
//   document.forms['copysheetform'].submit();
//   window.location.href = "{{ route('testSheets.index',$editData->project_id)}}";
// }

 $( function() {
  $( "#start_date" ).datepicker({
    format: 'yyyy/mm/dd',
    todayBtn: true,
    clearBtn: true,
    autoclose: true,
    todayHighlight: true
  });

  $( "#schedules_end_date" ).datepicker({
    format: 'yyyy/mm/dd',
    todayBtn: true,
    clearBtn: true,
    autoclose: true,
    todayHighlight: true
  });
} );

        var text = document.getElementById('appmemo').value,
        target = document.getElementById('editSection'),
        converter = new showdown.Converter(),
        html = converter.makeHtml(text);
        target.innerHTML = html;

        var editor = new tui.Editor({
          el: document.querySelector('#editSection'),
          height: '400px',
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




///////////APP DELETE OPERATION ////////////////////
  $('body').on('click','.appdelbtn',function(e){
     e.preventDefault();

    var appid = $(this).attr('data');

        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
             $.ajax({
                url: '',
                type: 'DELETE',
                data: {
                "appid": appid
              },
                success: function(response){
                $.iaoAlert({msg: "Data has been deleted",
                type: "success",
                mode: "dark",});
                  setTimeout(function(){// wait for 5 secs(2)
                    document.location.href="{!! route('apps.index', $id); !!}";
                   // location.reload(); // then reload the page.(3)
                  }, 1500);
                }
            });


    });





        //BIND TOAST UI EDITOR CONTENT TO TEXTAREA WHEN SUBMIT BUTTON CLICKED
        $("#appeditform").submit(function(e){
          var content2bSaved = editor.getValue();
          //var content2bSaved = editor.getHtml();
          $('#content2bSavedHolder').html(content2bSaved);
        });




  </script>

@endsection
