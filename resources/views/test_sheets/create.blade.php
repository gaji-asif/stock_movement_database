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
  form#appaddform input {
    border-radius: 0px;
    font-size: 13px;
  }
</style>
<div class="row">
  <div class="col-lg-10 issue_wrapper">
<!--     <h4 class="font-weight-bold py-3 mb-4">
      <span class="text-muted font-weight-light">Dashboard /</span> Apps
    </h4> -->
    <div class="mb-4">


      <div class="card-body gap">

        <h4 class="px-0" style="color: black">
          Add Test Sheet
          <a href="{{route('testSheets.index', $id)}}" class="btn btn-primary btn-sm pull-right dtb_custom_btn_default" style="margin-top: -1px">All Test Sheets</a>
        </h4>

        {!! Form::open(['route' => ['testSheets.store', $id], 'method' => 'POST','files' => true, 'enctype' => 'multipart/form-data','id' => 'appaddform','class' => 'form-horizontal'])!!}

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


        <input type="hidden" name="project_id" value="<?php echo $id; ?>">



        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
             <label class="col-form-label text-sm-right">Test Sheet Name</label>
             <div class="">
              <input name="name" type="text" class="form-control  {{ $errors->has('name') ? ' is-invalid' : '' }}"  value="{{ old('name') }}">
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
            <label class="col-form-label text-sm-right">App Name</label>
            <div class="">
              <select name="app_id" class="custom-select NoborderRadius" id="app_id" style="height: 40px;">
                <option value="">Select App Name</option>
                    @foreach($apps as $key => $app)
                    @if(old('app_id', $key) == $app->id )
                    <option value="{{ $app->id }}" selected >{{ $app->app_name }}</option>
                    @else
                    <option value="{{ $app->id }}">{{ $app->app_name }}</option>
                    @endif
                    @endforeach
              </select>


            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <label class="col-form-label text-sm-right">Version</label>
            <div class="">
              <select name="version_id" class="custom-select NoborderRadius" id="version_id" style="height: 40px;">
                <option value="">Select Version</option>
                {{-- @foreach($versions as $version)
                <option value="{{ $version->id }}">{{ $version->version_name }}</option>
                @endforeach --}}

                @foreach($versions as $key => $version)
                @if(old('version_id', $key) == $version->id )
                <option value="{{ $version->id }}" selected >{{ $version->version_name }}</option>
                @else
                <option value="{{ $version->id }}">{{ $version->version_name }}</option>
                @endif
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
              <input type="text" data-date="" data-date-format="YYY MMMM DD" name="start_date" id="start_date" class="controls input-append date form_datetime form-control {{ $errors->has('start_date') ? ' is-invalid' : '' }}" placeholder="start date" value="{{ old('start_date',isset($copyFlag) && $copyFlag?date( 'Y-m-d',strtotime($dtbissue->start_date)):date( 'Y/m/d',strtotime(now()))) }}">
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
              <input type="text" data-date="" data-date-format="YYY MMMM DD" name="schedules_end_date" id="schedules_end_date" class="controls input-append date form_datetime form-control {{ $errors->has('schedules_end_date') ? ' is-invalid' : '' }}" placeholder="End date" value="{{ old('schedules_end_date',isset($copyFlag) && $copyFlag?date( 'Y-m-d',strtotime($dtbissue->schedules_end_date)):date( 'Y/m/d',strtotime(now()))) }}">
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
           <label class="col-form-label text-sm-right">Details</label>
           <div class="">
            <div id="editSection"></div>
            <textarea id="content2bSavedHolder" name="detail" class="form-control" style="display: none;"> </textarea>

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
      <div class="col-sm-12 ml-sm-auto text-center">
        <button type="submit" class="btn btn-success dtb_custom_btn_default mt-4" style="padding: 5px 111px">Add</button>
      </div>
    </div>
  </form>
</div>
</div>
</div>
</div>



<link rel="stylesheet" href="{{asset('css/for_marked/bootstrap-markdown.min.css')}}" />
<link rel="stylesheet" href="{{asset('css/for_marked/style.css')}}" />

<!-- <link rel="stylesheet" href="https://uicdn.toast.com/tui-editor/latest/tui-editor.css"></link> -->
<!-- <link rel="stylesheet" href="https://uicdn.toast.com/tui-editor/latest/tui-editor-contents.css"></link> -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.33.0/codemirror.css"></link> -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/github.min.css"></link> -->
<!-- <script src="{{asset('js/tui-editor-Editor-full.js')}}"></script> -->
<link rel="stylesheet" href="{{asset('css/for_marked/codemirror.css')}}" />
<link rel="stylesheet" href="{{asset('css/for_marked/github.min.css')}}" />
<link rel="stylesheet" href="{{asset('tui-editor/css/tui-editor.css')}}" />
<link rel="stylesheet" href="{{asset('tui-editor/css/tui-editor-contents.css')}}" />
<script src="{{asset('js/for_marked/tui-editor-Editor-full.js')}}"></script>



<script type="text/javascript">

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



          //initial content
          var content = [' * * *',' ',].join('\n');

          //TOAST UI MAIN SETTINGS
          var editor = new tui.Editor({
            el: document.querySelector('#editSection'),
            initialEditType: 'markdown',
              // initialEditType: 'wysiwyg',
              initialValue: content,
              previewStyle: 'vertical',
              height: '300px',
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
                            //var cllbackimg = document.location.origin +'/developmanage/public/'+myupload;
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








        //BIND TOAST UI EDITOR CONTENT TO TEXTAREA WHEN SUBMIT BUTTON CLICKED
        $("#appaddform").submit(function(e){;
          var content2bSaved = editor.getValue();
          //var content2bSaved = editor.getHtml();
          $('#content2bSavedHolder').html(content2bSaved);

        });


      //FOR SHOWING MARKDOWN CONTENT USING SHOWDOWN JS
      // var markedcontent = document.getElementById('content').innerHTML =
      //   marked('<?php //if (!empty($wikipage)) {echo $wikipage->description; } ?>');

    </script>




    @endsection
