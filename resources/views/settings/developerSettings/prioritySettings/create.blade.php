@extends('master_main')
@section('mainContent')

<div class="container pt-5">
  <div class="row">

    <div class="col-lg-3">
     @include('settings.developerSettings.developer_settings_sidebar')
   </div>

   <div class="col-lg-9 settgs_right_content">
    <div class="card mb-4 no_border">
      <div class="card-body padding_left_right">
  
<div class="row">
  <div class="col-lg-12">

      <!--   <h6 class="card_body_header" style="padding-left: 0px;float: left">Add Priority</h6>
        <span style="float: right;" class="pull-right"><a href="{{route('priorityss')}}" class="pull-right btn btn-success btn-sm dtb_custom_btn_default" style="float: right;">All Priority</a></span> -->

        <span class="text-left" style="margin-right: 68%;">
          <h6 class="card_body_header" style="padding-left: 0px;float: left">Add Priority</h6>
        </span>
        <span style="float: right; margin-top:-10px;"><a href="{{route('priorityss')}}" class="pull-right btn btn-success btn-sm dtb_custom_btn_default">All Priority</a></span>

      </div>
    </div>


       <div class="row noticeformholder">

          {!! Form::open(['route' => ['priority-create'], 'enctype' => 'multipart/form-data', 'id' => 'wikieditform', 'class' => 'pl-3'])!!}
          {{ method_field('post') }}

          @if(session()->has('message'))

          <div class="alert success_message mb-10 background-success" role="alert">
            {{ session()->get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          @endif


          
 <div class="form-row">
          <div class="form-group col mb-0">
            <label class="form-label">Priorities</label>
            <input required type="text" id="priority_name" name="priority_name" value="{{ old('priority_name') }}" class="form-control required" placeholder="">

          </div>
          <div class="form-group col mb-0">
          </div>
        </div>        

        <div class="form-row mt-4">
          <div class="form-group col">
            <label class="form-label">Select Background color for the Priority</label>
            <div class="demo-inline-spacing issuebgcolorholder">
            
              <label class="switcher switcher-square">
                  <input type="checkbox" name="color" value="#d73a4a" id="color" class="switcher-input required editcolor">
                  <span class="switcher-indicator">
                    <span class="switcher-yes"></span>
                    <span class="switcher-no red"></span>
                  </span>
                  <span class="switcher-label"></span>
                </label>  

                <label class="switcher switcher-square">
                  <input type="checkbox" class="switcher-input editcolor"  name="color" value="#b6DD05">
                  <span class="switcher-indicator">
                    <span class="switcher-yes"></span>
                    <span class="switcher-no green"></span>
                  </span>
                  <span class="switcher-label"></span>
                </label>

                <label class="switcher switcher-square">
                  <input type="checkbox" class="switcher-input editcolor"  name="color" value="#0075ca">
                  <span class="switcher-indicator">
                    <span class="switcher-yes"></span>
                    <span class="switcher-no blue"></span>
                  </span>
                  <span class="switcher-label"></span>
                </label>


                <label class="switcher switcher-square">
                  <input type="checkbox" class="switcher-input editcolor" name="color" value="#e4e669">
                  <span class="switcher-indicator">
                    <span class="switcher-yes"></span>
                    <span class="switcher-no yellow"></span>
                  </span>
                  <span class="switcher-label"></span>
                </label>               


                 <label class="switcher switcher-square">
                  <input type="checkbox" class="switcher-input editcolor" name="color" value="#4caf93">
                  <span class="switcher-indicator">
                    <span class="switcher-yes"></span>
                    <span class="switcher-no color5"></span>
                  </span>
                  <span class="switcher-label"></span>
                </label>




                 <label class="switcher switcher-square">
                  <input type="checkbox" class="switcher-input editcolor" name="color" value="#f42858">
                  <span class="switcher-indicator">
                    <span class="switcher-yes"></span>
                    <span class="switcher-no color6"></span>
                  </span>
                  <span class="switcher-label"></span>
                </label>

                <label class="switcher switcher-square" style="padding-left: 0px">
                <input type="text" placeholder="put cursor to pick color" value="" class="editcolor jscolor {required:false,hash:true,refine:false,width:243, zIndex:99999, height:150,borderColor:'#FFF', backgroundColor:'#666'} " style="border: 1px solid #80808075;border-radius: 3px;padding: 2px 5px;font-size: 13px;" value="#f3f3f3">
                <input type="checkbox" id="inptcolorvalue"  name="color" style="display: none;">
                </label>

                </div>
          </div>
        </div>   
        
        @if(session()->has('message-color'))

          <div class="alert  alert-danger" role="alert">
            {{ session()->get('message-color') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          @endif   


        <label class="form-label">Existing Items</label>
         <div class="form-row mt-1">

          <div class="form-group col" style="padding: 17px 8px 3px;background: #00000012;">
            <div class="demo-inline-spacing">
               @forelse ($dtbpriorities as $priority)
              <span class="btn btn-sm" style="color:white;background: {{ $priority->color }}">{{ $priority->priority_name }}</span>
              @empty
                <p>No users</p>
              @endforelse 
            </div>
          </div>
        </div>
          


          
       
          <div class="form-group row pt-5">
                  <div class="col-sm-12 ml-sm-auto">
                    <input type="submit" class="col-lg-5 btn btn-success dtb_custom_btn_default button_middle" value="Submit" onclick="select_color();">
                  </div>
                </div>
       {{ Form::close()}}

      </div>

    </div>

  </div>
</div>
</div>
<!-- <script type="text/javascript">
  function select_color(){
  if ($('input.editcolor').is(':checked')) {
    alert("c");
    }
    else{
      return false;
       event.preventDefault();
    }
  }
</script> -->
<style type="text/css">
  .noticeformholder form{
    width: 100%;
  }
  div#cke_noticeeditor {
    width: 100%;
  }
</style>
</div>
<textarea id="wikidescsrc" rows="10" cols="82" style="display: none;">
  <?php if (!empty($dtbdevelopgroup)) { echo $dtbdevelopgroup->notice;} ?>
</textarea>


<script src="{{asset('/assets/js/showdown.min.js')}}"></script>
<link rel="stylesheet" href="https://uicdn.toast.com/tui-editor/latest/tui-editor.css"></link>
<link rel="stylesheet" href="https://uicdn.toast.com/tui-editor/latest/tui-editor-contents.css"></link>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.33.0/codemirror.css"></link>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/github.min.css"></link>
<script src="https://uicdn.toast.com/tui-editor/latest/tui-editor-Editor-full.js"></script>


<script type="text/javascript">

  var text = document.getElementById('wikidescsrc').value,
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
    //console.log(images);
    var myresult = "";
    var dataimg = new FormData();
    var form = dataimg.append('file', images);

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      url : '{{ url('newsfileupload') }}',
      method: 'POST',
      async: false,
      cache : false,
      contentType : false,
      processData : false,
      data :  dataimg,
      success: function (response) {
        //console.log(response);
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
        $("#wikieditform").submit(function(e){
          var content2bSaved = editor.getValue(); 
          //var content2bSaved = editor.getHtml();
          $('#content2bSavedHolder').html(content2bSaved);
        });


        //ADD DUMMY CONTENT TO EDITOR
        //DUMMY CONTENT OF MARKDOWN EDITOR
        var dummycontent = [
        '![image](http://tk2-402-42070.vs.sakura.ne.jp/storage/spaceimage/uER0mH4ojyZCUEg8vtpdQD9FBURYadQg4RXLf9GE.png)',
        '# Heading 1',
        '## Heading 2',
        '### Heading 3',
        '#### Heading 4',
        '##### Heading 5',
        '###### Heading 6',
        '    code block',
        '```js',
        'console.log("fenced code block");',
        '```',
        '<pre>**HTML block**</pre>',
        '* list',
        '    * list indented',
        '1. ordered',
        '2. list',
        '    1. ordered list',
        '    2. indented',
        '',
        '- [ ] task',
        '- [x] list completed',
        '',
        '[link](https://nhn.github.io/tui.editor/)',
        '> block quote',
        '---',
        '```youtube',
        'XGSy3_Czz8k',
        '```',
        'horizontal line',
        '***',
        '`code`, *italic*, **bold**, ~~strikethrough~~, <span style="color:#e11d21">Red color</span>',
        '|table|head|',
        '|---|---|',
        '|table|body|'
        ].join('\n');
        var el = document.querySelector('#dummycontentaddbtn');
        el.addEventListener('click', function(e){
         e.preventDefault();
         editor.setValue(dummycontent)
       });

     </script>

     <style type="text/css">
       .wikipagelinkholder  li.list-group-item.d-flex.justify-content-between.align-items-center {
        padding: 8px 16px 8px 17px;
      }
      .wikipagelinkholder li.list-group-item.d-flex.justify-content-between.align-items-center:hover {
        background: #02bc7736;
      }
      .wikipagelinkholder li.list-group-item.d-flex.justify-content-between.align-items-center:before {
        content: '';
        position: absolute;
        left: 13px;
        font-size: 10px;
        background: #00000045;
        width: 4px;
        height: 6px;
      }
      .wikipagelinkholder li.list-group-item.d-flex.justify-content-between.align-items-center a {
        padding-left: 7px;
      }
      .editformheader {
        width: 74%;
        background: white;
        padding: 7px;
        margin: 1px 2px 4px;
      }
      button#dummycontentaddbtn {
        background: #ffd9501f;
        border: 1px solid #02bc7745;
        border-radius: 3px;
        font-size: 12px;
        font-weight: 500;
      }
    </style>


<style>
  .btn-outline-primary {
    border: 1px solid #38587d;
    border-radius: 0px;
    color: #38587d;
}  

.btn-outline-primary:hover {
  background: #718AA8;
  color: white;
}
</style>


<script src="{{asset('js/jscolor.js')}}"></script>
<script type="text/javascript">
$( document ).ready(function() {

$('body').on('click','.priorityeditmodal',function(e){

  e.preventDefault();

var priorityid = $(this).attr('value');
var projectid = $(this).attr('data-projectid');
var priority_name = $(this).attr('data-priority');
var oldcolor = $(this).attr('data-prioritycolor');

$("#edit_priority_name").val(priority_name);

$(".editcolors").val(priority_name);
$('.editcolors').css('background',oldcolor)


$('body').on('click','.updateprioritysavebtn',function(e){

  e.preventDefault();

  var priorityvalue = $("#edit_priority_name").val();
  $('input[name="color"]:checked').each(function() {
    var colors = (this.value); 
    $(".newlycolor").val(colors);
  });

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

  var lastcolor = $(".newlycolor").val();

    $.ajax({
        url: 'priority/'+priorityid,
        type: 'POST',
        data: {
            priorityid:priorityid,
            projectid: projectid,
            priority_name: priorityvalue,
            color: lastcolor,
            oldcolor: oldcolor,
        },
        success: function(response){
          // alert(response);
          $('#priorityeditmodal').modal('hide');
          $("#msgcontainer").show();
          if (response) {
            $.iaoAlert({msg: "Data has been updated",
            type: "success",
            mode: "dark",})
            // $("#successmsg").html(response);
            // setTimeout(function() {
            //         $("#msgcontainer").fadeOut("slow");
            //     }, 2000 );
          }
          setTimeout(function(){// wait for 5 secs(2)
           location.reload(); // then reload the page.(3)
          }, 1500);
        }
    });
});




});




// priority delete
$('body').on('click','.prioritydelconfirmmodal',function(e){
var id = $(this).attr('value');
e.preventDefault();

  //when confirm modal clicked
  $('body').on('click','.prioritydelbtn',function(e){
    e.preventDefault();
    prioritydelete();
  });


function prioritydelete() {

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });


        $.ajax({
            url: 'priority/'+id,
            type: 'DELETE',
            data: {
            "id": id
        },
            success: function(response){

            $.iaoAlert({msg: "Data has been deleted",
            type: "success",
            mode: "dark",});

              //   $("#msgcontainer").show();
              //   if (response) {
              //       $("#successmsg").html(response);
              //       setTimeout(function() {
              //           $("#msgcontainer").fadeOut("slow");
              //       }, 2000 );
              // }

              setTimeout(function(){// wait for 5 secs(2)
                location.reload(); // then reload the page.(3)
              }, 1000);
            }
        });

  }
});

// PROJECT LIST DRAG DROP SORTING
$( "#tablecontents" ).sortable({
  items: "tr",
  cursor: 'move',
  opacity: 0.6,
  update: function() {
    sendOrderToServer();
  }
});
function sendOrderToServer() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var order = [];
    $('tr.row1').each(function(index,element) {
      order.push({
        id: $(this).attr('data-id'),
        position: index+1
      });
       // alert(JSON.stringify(order, null, 4));exit();
    });
    $.ajax({
        url: 'priority',
        type: 'PUT',
        data: {
            order:order,
           _token: '{{csrf_token()}}'
        },
        success: function(response){
          $("#msgcontainer").show();
          if (response) {
          $.iaoAlert({msg: "Ordering Successfull",
            type: "success",
            mode: "dark",})
          }
        },
        error: function() {
          alert('Error occurs!');
       }
    });
  }


//#############  CHECKING HIDDEN COLOR CHECKBOX WHEN PICKING COLOR FROM COLOR PALETTE #####################
  $(".jscolor").on("change", function(){
      var inputboxcolor = $(this).val();

      if (inputboxcolor != "") {
        $('#color-error').text('');
        $('#inptcolorvalue').attr('checked', true);
        $('#inptcolorvalue').val(inputboxcolor);
      }else{
        $('#inptcolorvalue').attr('checked', false);
        $('#inptcolorvalue').val("");
      }

  });
//###############################


  });
</script>

    @endsection


