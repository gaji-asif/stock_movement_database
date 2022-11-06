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
        Add Test Case
         <a href="{{route('testSheets.index', $id)}}" class="btn btn-primary btn-sm pull-right dtb_custom_btn_default" style="margin-top: -1px">Back</a>
    </h4>

  {!! Form::open(['route' => ['testCase.store', $id], 'method' => 'POST','files' => true, 'enctype' => 'multipart/form-data','id' => 'appaddform','class' => 'form-horizontal'])!!}

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
        
        <input type="hidden" name="testSheetID" value="<?php echo $testSheetID; ?>">



        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
             <label class="col-form-label text-sm-right">Test Case Name</label>
             <div class="">
              <input name="test_case_title" type="text" class="form-control  {{ $errors->has('test_case_title') ? ' is-invalid' : '' }}"  value="{{ old('test_case_title') }}">
              @if ($errors->has('test_case_title'))
              <span class="invalid-feedback" role="alert">
                <span class="messages"><strong>{{ $errors->first('test_case_title') }}</strong></span>
              </span>
              @endif
            </div>

            </div>
          </div>
           <div class="col-md-4">
            <div class="form-group">
              <label class="col-form-label text-sm-right">Status</label>
                 <div class="">
                  <select name="status" class="custom-select NoborderRadius {{ $errors->has('status') ? ' is-invalid' : '' }}" id="status" style="height: 40px;">
                <option value="">Select Status</option>
                <option value="1">active</option>
                <option value="2">draft</option>
                <option value="3">deprecated</option>
                </select>
                 @if ($errors->has('status'))
                <span class="invalid-feedback" role="alert">
                  <span class="messages"><strong>{{ $errors->first('status') }}</strong></span>
                </span>
                @endif
                </div> 
          </div>
        </div>

           <div class="col-md-4">
            <div class="form-group">
              <label class="col-form-label text-sm-right">Importance</label>
                 <div class="">
                  <select name="importance" class="custom-select NoborderRadius {{ $errors->has('importance') ? ' is-invalid' : '' }}" id="importance" style="height: 40px;" >
                <option value="">Select importance</option>
                <option value="1">L1</option>
                <option value="2">L2</option>
                <option value="3">L3</option>
                <option value="4">L4</option>
                <option value="5">L5</option>
                </select>
                 @if ($errors->has('importance'))
                <span class="invalid-feedback" role="alert">
                  <span class="messages"><strong>{{ $errors->first('importance') }}</strong></span>
                </span>
                @endif
                </div> 
          </div>

        </div>
      </div>        

       <div class="row">
          
           <div class="col-md-4">
            <div class="form-group">
              <label class="col-form-label text-sm-right">Priority</label>
                 <div class="">
                      <select name="priority" class="custom-select NoborderRadius" id="priority" style="height: 40px;">
                    <option value="">Select Priority</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                    </select>
                </div> 
          </div>
        </div>

           <div class="col-md-4">
            <div class="form-group">
              <label class="col-form-label text-sm-right">Result</label>
                 <div class="">
                  <select name="result" class="custom-select NoborderRadius {{ $errors->has('result') ? ' is-invalid' : '' }}" id="result" style="height: 40px;">
                <option value="">Select Result</option>
                <option value="0">Once</option>
                <option value="1">Pass</option>
                <option value="2">Blocked</option>
                <option value="3">Retest</option>
                <option value="4">Failed</option>
                </select>
                 @if ($errors->has('result'))
                <span class="invalid-feedback" role="alert">
                  <span class="messages"><strong>{{ $errors->first('result') }}</strong></span>
                </span>
                @endif
                </div> 
          </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
              <label class="col-form-label text-sm-right">Test Type</label>
                 <div class="">
                      <select name="test_type" class="custom-select NoborderRadius {{ $errors->has('test_type') ? ' is-invalid' : '' }}" id="test_type" style="height: 40px;">
                    <option value="">Select Test Type</option>
                    <option value="0">Other</option>
                    <option value="1">Functional Test</option>
                   <option value="2">Smoke Test</option>
                   <option value="3">Regression Test</option>
                   <option value="4">Security Test</option>
                   <option value="5">Usability Test</option>
                   <option value="6">Performance Test</option>
                   <option value="7">Acceptance Test</option>
                  
                </select>
                 @if ($errors->has('test_type'))
                <span class="invalid-feedback" role="alert">
                  <span class="messages"><strong>{{ $errors->first('test_type') }}</strong></span>
                </span>
                @endif
                </div> 
          </div>
        </div>
      </div>  

      <div class="row">
          
           

           <div class="col-md-4">
            <div class="form-group">
              <label class="col-form-label text-sm-right">Behaviour</label>
                 <div class="">
                  <select name="behavior" class="custom-select NoborderRadius {{ $errors->has('behavior') ? ' is-invalid' : '' }}" id="behavior" style="height: 40px;">
                <option value="">Select Behaviour</option>
                <option value="0">Not Set</option>
                <option value="1">Postive</option>
                <option value="2">Negative</option>
                <option value="3">Destructive</option>
                
                </select>
                 @if ($errors->has('behavior'))
                <span class="invalid-feedback" role="alert">
                  <span class="messages"><strong>{{ $errors->first('behavior') }}</strong></span>
                </span>
                @endif
                </div> 
          </div>
        </div>

         <div class="col-md-4">
            <div class="form-group">
              <label class="col-form-label text-sm-right">Automation Status</label>
                 <div class="">
                  <select name="automation_status" class="custom-select NoborderRadius {{ $errors->has('automation_status') ? ' is-invalid' : '' }}" id="automation_status" style="height: 40px;">
                <option value="">Select Automation Status</option>
                <option value="1">Not automated</option>
                <option value="2">To be automated</option>
                <option value="3">Automated</option>
                
                </select>
                 @if ($errors->has('automation_status'))
                <span class="invalid-feedback" role="alert">
                  <span class="messages"><strong>{{ $errors->first('automation_status') }}</strong></span>
                </span>
                @endif
                </div> 
          </div>
        </div>
      </div>  

      <div class="row">
          <div class="col-md-6">
            <div class="form-group">
             <label class="col-form-label text-sm-right">Summary</label>
             <div class="">
              <div id="editSection"></div>
              <textarea id="content2bSavedHolder" name="summary" class="form-control" style="display: none;"> </textarea>

              @if ($errors->has('detail'))
              <span class="invalid-feedback" role="alert">
                <span class="messages"><strong>The detail field is required</strong></span>
              </span>
              @endif
            </div>
          </div>
        </div>

         <div class="col-md-6">
            <div class="form-group">
             <label class="col-form-label text-sm-right">Precondition</label>
             <div class="">
              <div id="editSection1"></div>
              <textarea id="content2bSavedHolder1" name="precondition" class="form-control" style="display: none;"> </textarea>

              @if ($errors->has('precondition'))
              <span class="invalid-feedback" role="alert">
                <span class="messages"><strong>The Precondition field is required</strong></span>
              </span>
              @endif
            </div>
          </div>
        </div>
      </div>

       <div class="row">
          <div class="col-md-6">
            <div class="form-group">
             <label class="col-form-label text-sm-right">Step</label>
             <div class="">
              <div id="editSection2"></div>
              <textarea id="content2bSavedHolder2" name="step" class="form-control" style="display: none;"> </textarea>

              @if ($errors->has('step'))
              <span class="invalid-feedback" role="alert">
                <span class="messages"><strong>The detail field is required</strong></span>
              </span>
              @endif
            </div>
          </div>
        </div>

         <div class="col-md-6">
            <div class="form-group">
             <label class="col-form-label text-sm-right">Expected</label>
             <div class="">
              <div id="editSection3"></div>
              <textarea id="content2bSavedHolder3" name="expected" class="form-control" style="display: none;"> </textarea>

              @if ($errors->has('expected'))
              <span class="invalid-feedback" role="alert">
                <span class="messages"><strong>The Precondition field is required</strong></span>
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


    <script type="text/javascript">

          //initial content
          var content = [' * * *',' ',].join('\n');

          //TOAST UI MAIN SETTINGS
          var editor = new tui.Editor({
              el: document.querySelector('#editSection1'),
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
                            var myupload = ImageUpload1(blob);
                            //console.log(blob);
                            var cllbackimg = myupload;
                            //var cllbackimg = document.location.origin +'/developmanage/public/'+myupload;
                            callback(cllbackimg, 'alt text');
                        }
                    }
          });

          function ImageUpload1(images){

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


<script type="text/javascript">

          //initial content
          var content = [' * * *',' ',].join('\n');

          //TOAST UI MAIN SETTINGS
          var editor = new tui.Editor({
              el: document.querySelector('#editSection2'),
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
                            var myupload = ImageUpload2(blob);
                            //console.log(blob);
                            var cllbackimg = myupload;
                            //var cllbackimg = document.location.origin +'/developmanage/public/'+myupload;
                            callback(cllbackimg, 'alt text');
                        }
                    }
          });

          function ImageUpload2(images){

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
          $('#content2bSavedHolder2').html(content2bSaved);
          

        });


      //FOR SHOWING MARKDOWN CONTENT USING SHOWDOWN JS
      // var markedcontent = document.getElementById('content').innerHTML =
      //   marked('<?php //if (!empty($wikipage)) {echo $wikipage->description; } ?>');


    </script>

    <script type="text/javascript">

          //initial content
          var content = [' * * *',' ',].join('\n');

          //TOAST UI MAIN SETTINGS
          var editor = new tui.Editor({
              el: document.querySelector('#editSection3'),
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
                            var myupload = ImageUpload3(blob);
                            //console.log(blob);
                            var cllbackimg = myupload;
                            //var cllbackimg = document.location.origin +'/developmanage/public/'+myupload;
                            callback(cllbackimg, 'alt text');
                        }
                    }
          });

          function ImageUpload3(images){

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
          $('#content2bSavedHolder3').html(content2bSaved);
          

        });


      //FOR SHOWING MARKDOWN CONTENT USING SHOWDOWN JS
      // var markedcontent = document.getElementById('content').innerHTML =
      //   marked('<?php //if (!empty($wikipage)) {echo $wikipage->description; } ?>');


    </script>

@endsection
