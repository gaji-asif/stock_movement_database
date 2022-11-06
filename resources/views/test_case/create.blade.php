
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

#tested_date{z-index:1151 !important;}
#production_tested_date{z-index:1151 !important;}

.datepicker{
  z-index: 999999 !important;
}

.dropdown-menu {
  z-index: 999999 !important;
}

.datepicker{
  z-index: 999999 !important;
}

.datepicker-orient-left {
  z-index: 999999 !important;
}

.datepicker-orient-bottom{
  z-index: 999999 !important;
}

.datepicker-dropdown {
  z-index: 999999 !important;
}



#showDetaildModalBody{
  z-index: 1 !important;
}
</style>
<div class="row">
  <div class="col-lg-12 issue_wrapper">
<!--     <h4 class="font-weight-bold py-3 mb-4">
      <span class="text-muted font-weight-light">Dashboard /</span> Apps
    </h4> -->
    <div class="mb-4">


      <div class="card-body gap">

    <!-- <h4 class="px-0" style="color: black">
        Add Test Case
         <a href="{{route('testSheets.show', [$id, $testSheetID])}}" class="btn btn-primary btn-sm pull-right dtb_custom_btn_default" style="margin-top: -1px">Back</a>
    </h4> -->

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
             <label class="col-form-label text-sm-right">Function Group Screen</label>
             <div class="">
              <input name="functions_screen" type="text" class="form-control  {{ $errors->has('functions_screen') ? ' is-invalid' : '' }}"  value="{{ old('functions_screen') }}" required="required">
              @if ($errors->has('functions_screen'))
              <span class="invalid-feedback" role="alert">
                <span class="messages"><strong>The Function Group Screen field is required</strong></span>
              </span>
              @endif
            </div>

            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
             <label class="col-form-label text-sm-right">Functions Name</label>
             <div class="">
              <input name="functions" type="text" class="form-control  {{ $errors->has('functions') ? ' is-invalid' : '' }}"  value="{{ old('functions') }}">
              @if ($errors->has('functions'))
              <span class="invalid-feedback" role="alert">
                <span class="messages"><strong>{{ $errors->first('functions') }}</strong></span>
              </span>
              @endif
            </div>

            </div>
          </div>
           <!-- <div class="col-md-4">
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
        </div> -->


      </div>
  <!--   <h6 style="font-weight: bold;">Staging</h6> -->
       <div class="row">
        <div class="col-md-4">
            <div class="form-group">
             <label class="col-form-label text-sm-right">Result</label>
             <div class="">
                  <select name="tested_result" class="custom-select NoborderRadius {{ $errors->has('tested_result') ? ' is-invalid' : '' }}" id="tested_result" style="height: 40px;">
                <option value="">Select Result</option>
                 <option value="OK" @if(old('tested_result') == 'OK') selected @endif >OK</option>
                 <option value="NG"   @if(old('tested_result') == 'NG') selected @endif >NG</option>
                 <option value="Pending"  @if(old('tested_result') == 'Pending') selected @endif >Pending</option>
                </select>
                  @if ($errors->has('tested_result'))
                <span class="invalid-feedback" role="alert">
                  <span class="messages"><strong>{{ $errors->first('tested_result') }}</strong></span>
                </span>
                @endif
                </div>

            </div>
          </div>

           <div class="col-md-4">
            <div class="form-group">
                @php
                    use Illuminate\Support\Facades\Input as Input;
                @endphp
              <label class="col-form-label text-sm-right">Tested By</label>
                 <div class="">
                  <select name="tested_by" class="custom-select NoborderRadius {{ $errors->has('tested_by') ? ' is-invalid' : '' }}" id="tested_by" style="height: 40px;" required="required">
                <option value="">Select Tester Name</option>
                  {{-- @foreach($all_users as $key => $all_user)
                  <option value="{{ $all_user->id }}"  {{ Input::old('tested_by') == $key ? 'selected="selected"' : '' }} >{{ $all_user->name }}</option>
                  @endforeach --}}
                  {{-- @foreach($all_users as $key => $all_user)
                  @if(old('tested_by', $all_user->id) == $key )
                    <option value="{{ $key }}" selected >{{ $all_user->name }}</option>
                  @else
                    <option value="{{ $key }}">{{ $all_user->name }}</option>
                  @endif
                  @endforeach --}}

                  @foreach($all_users as $key => $all_user)
                  @if(old('tested_by', $key) == $all_user->id )
                  <option value="{{ $all_user->id }}" selected >{{ $all_user->name }}</option>
                  @else
                  <option value="{{ $all_user->id }}">{{ $all_user->name }}</option>
                  @endif
                  @endforeach


                </select>
                  @if ($errors->has('tested_by'))
                <span class="invalid-feedback" role="alert">
                  <span class="messages"><strong>{{ $errors->first('tested_by') }}</strong></span>
                </span>
                <script>
                    $('#tested_by').val('');
                </script>
                @endif
                </div>

        </div>
      </div>

      <div class="col-md-4">
          <div class="form-group">
            <label class="col-form-label text-sm-right">Date</label>
            <div class="">
              <input type="date" data-date-format="YYY MMMM DD" name="tested_date" id="tested_date" class="controls input-append date form_datetime form-control {{ $errors->has('tested_date') ? ' is-invalid' : '' }}" placeholder="start date" value="{{ old('tested_date',isset($editData) && $editData?date( 'Y-m-d',strtotime($editData->tested_date)):date( 'Y/m/d',strtotime(now()))) }}" required="required">
              @if ($errors->has('tested_date'))
              <span class="invalid-feedback" role="alert">
                <span class="messages"><strong>{{ $errors->first('tested_date') }}</strong></span>
              </span>
              @endif
            </div>
          </div>
        </div>


      </div>
<!-- <h6 style="font-weight: bold;">Production</h6>

       <div class="row">
        <div class="col-md-4">
            <div class="form-group">
             <label class="col-form-label text-sm-right">Result</label>
             <div class="">
              <input name="production_tested_result" type="text" class="form-control  {{ $errors->has('production_tested_result') ? ' is-invalid' : '' }}"  value="{{ old('production_tested_result') }}">
              @if ($errors->has('production_tested_result'))
              <span class="invalid-feedback" role="alert">
                <span class="messages"><strong>{{ $errors->first('production_tested_result') }}</strong></span>
              </span>
              @endif
            </div>

            </div>
          </div>

           <div class="col-md-4">
            <div class="form-group">

              <label class="col-form-label text-sm-right">Tested By</label>
                 <div class="">
                  <select name="production_tested_by" class="custom-select NoborderRadius" id="production_tested_by" style="height: 40px;">
                <option value="">Select Tester Name</option>
                  @foreach($all_users as $all_user)
                  <option value="{{ $all_user->id }}">{{ $all_user->name }}</option>
                  @endforeach
                </select>
                </div>

        </div>
      </div>

      <div class="col-md-4">
          <div class="form-group">
            <label class="col-form-label text-sm-right">Date</label>
            <div class="">
              <input type="text" data-date="" data-date-format="YYY MMMM DD" name="production_tested_date" id="production_tested_date" class="controls input-append date form_datetime form-control {{ $errors->has('production_tested_date') ? ' is-invalid' : '' }}" placeholder="start date" value="{{ old('production_tested_date',isset($editData) && $editData?date( 'Y-m-d',strtotime($editData->production_tested_date)):date( 'Y/m/d',strtotime(now()))) }}">
              @if ($errors->has('production_tested_date'))
              <span class="invalid-feedback" role="alert">
                <span class="messages"><strong>{{ $errors->first('production_tested_date') }}</strong></span>
              </span>
              @endif
            </div>
          </div>
        </div>


      </div>  -->



      <div class="row">
          <div class="col-lg-12">
            <div class="form-group">
             <label class="col-form-label text-sm-right">Content</label>
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


      </div>





  <div class="form-group row">
    <div class="col-sm-12 ml-sm-auto text-center">
      <button type="submit" onclick="submitFunction();" class="btn btn-success dtb_custom_btn_default mt-4" style="padding: 5px 111px">Add</button>
    </div>
  </div>
</form>
</div>
</div>
</div>
</div>

<script type="text/javascript">

  function submitFunction(){
       var content2bSaved = editor.getValue();
          
          //var content2bSaved = editor.getHtml();
          $('#content2bSavedHolder').html(content2bSaved);
  }
 
</script>

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


//  $( function() {
//   $( "#tested_date" ).datepicker({
//     format: 'yyyy/mm/dd',
//     todayBtn: true,
//     clearBtn: true,
//     autoclose: true,
//     todayHighlight: true
//   });

//   $( "#production_tested_date" ).datepicker({
//     format: 'yyyy/mm/dd',
//     todayBtn: true,
//     clearBtn: true,
//     autoclose: true,
//     todayHighlight: true
//   });
// } );

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
        $("#appaddform").submit(function(e){
          var content2bSaved = editor.getValue();
          alert(content2bSaved);
          //var content2bSaved = editor.getHtml();
          $('#content2bSavedHolder').html(content2bSaved);


        });


      //FOR SHOWING MARKDOWN CONTENT USING SHOWDOWN JS
      // var markedcontent = document.getElementById('content').innerHTML =
      //   marked('<?php //if (!empty($wikipage)) {echo $wikipage->description; } ?>');


    </script>

<!--
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


    </script> -->



