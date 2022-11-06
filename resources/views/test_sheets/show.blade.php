@extends('master')
@section('mainContent')
<style type="text/css">
  img {
    vertical-align: middle;
    border-style: none;
    max-width: 100%;
  </style>
  <br><br>
<!-- <div class="row">
  <div class="col-lg-12" style="margin-bottom: 20px;">
 <a class="btn btn-info btn-sm pull-right" style="float: right;" href="{{route('testSheets.create', $id)}}">Add New Test Sheet</a>
</div>
</div> -->
<div class="row">

  <div class="col-lg-1"></div>
  <div class="col-lg-10">
    <div class="row" style="margin-bottom: 10px;">
      <div class="col-lg-12">
       <h4 style="color: black">

         <a href="{{route('testSheets.index', [$id])}}" class="btn btn-primary btn-sm pull-right dtb_custom_btn_default" style="margin-top: -30px">Back</a>
       </h4>
     </div>
   </div>

   <div class="form-group row">
    <div class="col-sm-12">
      @if(session()->has('message'))
      <br>
      <div class="alert alert-success mb-0 background-success" role="alert" style="border-radius: 12px;padding-right: 30px;padding-left: 28px">
        {{ session()->get('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
    </div>
  </div>

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
                      <div class="col-md-12">
                        <h4 class="card-title" style="padding-left: 0px;margin-left: -5px;font-weight: 600;margin-bottom: 13px;"><span style="font-size: 14px;font-weight: 500;float: left;margin-right: 6px;margin-top: 5px;color: #0000008a;"></span>{{$testSheetName->name}}



                         <!-- <a href="{{route('testCase.create', [$id, $testSheetID])}}" class="btn btn-primary btn-sm pull-right dtb_custom_btn_default" style="margin-bottom: 20px;">Add New Test Case</a> -->

                         <a href="{{route('testCase.create', [$id, $testSheetID])}}" class="btn btn-primary btn-sm pull-right modalLinkNew dtb_custom_btn_default" style="margin-bottom: 20px;" data-modal-size="modal-xl" data-title="Add New Test Case">Add New Test Case</a>
                       </h4>
                     </div>


                   </div>


                   <div class="row">
                    <div class="col-lg-4">
                     <div class="py-4 px-3">
                      <div style="height:162px;">
                        <canvas id="statistics-chart-6"></canvas>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-8">

                   <div class="row">

                    <div class="col-lg-4">
                      <form>
                        <input type="hidden" id="totalOkResults" name="" value="{{count($totalOkResults)}}">
                        <input type="hidden" id="totalNGResults" name="" value="{{count($totalNGResults)}}">
                        <input type="hidden" id="totalPendingResults" name="" value="{{count($totalPendingResults)}}">
                      </form>
                      <div class="card mb-4">
                        <div class="card-header border-0 pb-0">Result - OK</div>
                        <div class="card-body text-center text-success text-xlarge py-3">{{count($totalOkResults)}}</div>
                        <div class="card-footer border-0 small pt-0">
                          <div class="float-right text-success">
                            <small class="ion ion-md-arrow-round-up"></small>
                            @php
                            $ok = number_format(count($totalOkResults));
                            $total = number_format(count($totalResults));

                            if($ok == 0){
                            echo 0;
                          }
                          else{
                          $result = ($ok*100)/$total;
                          echo number_format($result, 2);
                        }

                        @endphp
                        %
                      </div>
                      <span class="text-muted"><strong>Total:</strong> {{count($totalResults)}}</span>
                    </div>
                  </div>
                </div>

                <div class="col-lg-4">

                 <div class="card mb-4">
                  <div class="card-header border-0 pb-0">Result - NG</div>
                  <div class="card-body text-center text-success text-xlarge py-3">{{count($totalNGResults)}}</div>
                  <div class="card-footer border-0 small pt-0">
                    <div class="float-right text-success">
                      <small class="ion ion-md-arrow-round-up"></small>
                      @php
                      $ok = number_format(count($totalNGResults));
                      $total = number_format(count($totalResults));
                      if($ok == 0){
                      echo 0;
                    }
                    else{
                    $result = ($ok*100)/$total;
                    echo number_format($result, 2);
                  }
                  @endphp
                  %
                </div>
                <span class="text-muted"><strong>Total:</strong> {{count($totalResults)}}</span>
              </div>
            </div>
          </div>

          <div class="col-lg-4">

           <div class="card mb-4">
            <div class="card-header border-0 pb-0">Result - Pending</div>
            <div class="card-body text-center text-success text-xlarge py-3">{{count($totalPendingResults)}}</div>
            <div class="card-footer border-0 small pt-0">
              <div class="float-right text-success">
                <small class="ion ion-md-arrow-round-up"></small>
                @php
                $ok = number_format(count($totalPendingResults));
                $total = number_format(count($totalResults));
                if($ok == 0){
                echo 0;
              }
              else{
              $result = ($ok*100)/$total;
              echo number_format($result, 2);
            }
            @endphp
            %
          </div>
          <span class="text-muted"><strong>Total:</strong> {{count($totalResults)}}</span>
        </div>
      </div>
    </div>
  </div>

  <div class="row" style="margin-top: 15px;">
    <div class="col-sm-6 col-xl-3 mr-1">

      <div class="card mb-4">
        <div class="" style="padding: 10px;">
          <div class="d-flex align-items-center">

            <div class="ml-3">
              <div class="text-muted small"><strong>App Name</strong></div>
              <div class="">{{$testSheetName->app_name}}</div>
            </div>
          </div>
        </div>
      </div>

    </div>


    <div class="col-sm-6 col-xl-3 mr-1">

      <div class="card mb-4">
        <div class="" style="padding: 10px;">
          <div class="d-flex align-items-center">

            <div class="ml-3">
              <div class="text-muted small"><strong>Version Name</strong></div>
              <div class="">{{$testSheetName->version_name}}</div>
            </div>
          </div>
        </div>
      </div>

    </div>
    <div class="col-sm-6 col-xl-4 mr-4">

      <div class="card mb-4">
        <div class="" style="padding: 10px;">
          <div class="d-flex align-items-center">

            <div class="ml-3">
              <div class="text-muted small"><strong>Start Date  &nbsp;-&nbsp;  End Date</strong></div>
              <div class=""> @if(!empty($testSheetName->start_date))
                {{$testSheetName->start_date}}
                @endif
                &nbsp;-&nbsp;
                @if(!empty($testSheetName->schedules_end_date))
                {{$testSheetName->schedules_end_date}}
                @endif

              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="col-sm-4 col-xl-1 pull-right">
      <a  href="{{route('testSheets.edit', [$id,$testSheetName->id])}}"> <button class="btn pull-right" style="border-radius: 20px; background-color:#38587D; color: #FFFFFF; margin-top: 8px; float: right;">

        Edit

      </button>
    </a>

  </div>
</div>




@if(!empty($testSheetName->detail))
<h6 class="card-header no_border px-1 pb-1">Detail</h6>
<div class="card mt-0 NoborderRadius"  style="background-color: #d6e0e4; margin-bottom: 30px;">
   <div class="card-body">
   
      <div class="tui-editor-contents">
         <?php 
         $parser = new \cebe\markdown\GithubMarkdown();
         $parser->html5 = true;
         $parser->enableNewlines = true;
         $parser->keepListStartNumber = true;         
         echo $parser->parse($testSheetName->detail);
         ?>
      </div>
   </div>

</div>
@endif

<!--  start serach area -->
<div class="row mt-2 pt-2">
  <div class="col-lg-12">

    {!! Form::open(['route' => ['seacrh_test_cases'], 'method' => 'POST','files' => true, 'enctype' => 'multipart/form-data','id' => 'appaddform','class' => 'form-horizontal'])!!}
    <!-- Filters -->
    <input type="hidden" name="testSheetID" id="testSheetID" value="{{$testSheetID}}">
    <input type="hidden" name="project_id" id="project_id" value="{{$id}}">
    <div class="row">

      <div class="col-lg-6">
        <div class="form-group">
         <label class="form-label">Select Result Types For filtering test cases</label>
         <select class="user-edit-multiselect form-control w-100" multiple name="results[]">
          <option value="OK"
          @if(isset($search_results_type))
          @if(in_array("OK", $search_results_type))
          selected
          @endif
          @endif
          >OK</option>
          <option value="NG"
          @if(isset($search_results_type))
          @if(in_array("NG", $search_results_type))
          selected
          @endif
          @endif
          >NG</option>
          <option value="Pending"
          @if(isset($search_results_type))
          @if(in_array("Pending", $search_results_type))
          selected
          @endif
          @endif
          >Pending</option>
        </select>

      </div>
    </div>
    <div class="col-lg-2 pt-4">
      <button type="submit" class="btn btn-success dtb_custom_btn_default">Search</button>
    </div>
    <div class="col-lg-2">


    </div>
  </div>

  <!--  <div class="col-lg-12 text-center loader_class" style="display: none;">
            <img class="img-responsive" src="{{asset('assets_/img/loader.gif')}}" height="80" width="80">
          </div> -->
          {{ Form::close()}}
        </div>
      </div>
    </div>
  </div>

  


  <table class="table table-striped table-bordered issueofapptbl dtb_custom_tbl_common col-lg-12" style="margin-bottom: 0px" id="">
    <thead>
      <tr>
        <th ></th>
        <th width="140px">Function Group (Screen)</th>
        <th width="140px">Function</th>
        <th width="320px">Detail</th>
        <th width="140px;">Result</th>
        <th width="180px;">Tester</th>
        <th>Date</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody id="tcaseordering">


      @if(isset($testCases))
      @foreach ($testCases as $testCase)
      <tr style="padding: 7px;" role="row" class="odd row1" data-id="{{ $testCase->id }}" id="{{$testCase->id}}">

        <td class="py-0 sorting_1 " ><div style="display: flex;color: #00000063;margin-left: 3px;margin-top: 4px"> <i class="fas fa-th-list d-block"></i></div></td>
        <td style="text-align: center;">{{ $testCase->functions_screen}}</td>
        <td style="text-align: center;">{{ $testCase->functions}}</td>

        <td style="text-align: center;">
          <?php
          $parser = new \cebe\markdown\GithubMarkdown();
          $parser->html5 = true;
          $parser->enableNewlines = true;
          $parser->keepListStartNumber = true;
          echo $parser->parse($testCase->summary);

          ?>
        </td>

        <td style="text-align: center;">
         @if(!empty($testCase->tested_result))
         @if($testCase->tested_result == 'OK')
         <button class="btn btn-success" style="border-radius: 20px;">

          {{$testCase->tested_result}}

        </button>
        @endif

        @if($testCase->tested_result == 'NG')
        <button class="btn btn-danger" style="border-radius: 20px;">

          {{$testCase->tested_result}}

        </button>
        @endif

        @if($testCase->tested_result == 'Pending')
        <button class="btn" style="border-radius: 20px; background-color:#38587D; color: #FFFFFF;">

          {{$testCase->tested_result}}

        </button>
        @endif
        @endif
      </td>

      <td style="text-align: center; padding: 8px;">
        @if(!empty($testCase->user_tested))
        @php $image_path = ""; @endphp
        @if(!empty($testCase->icon_image_path))
        @php $image_path = url($testCase->icon_image_path); @endphp
        <img src="//{{substr($image_path,env('AWS_BASE_URL'))}}" alt="" class="ui-w-40 rounded-circle">
        @else
        <img src="{{asset('assets_/img/user_avatar.png')}}" alt="" class="ui-w-40 rounded-circle">
        @endif
        &nbsp;  &nbsp;
        {{$testCase->user_tested}}
        @endif
      </td>

      <td  style="text-align: center;">
        @if(!empty($testCase->tested_date))
        {{$testCase->tested_date}}
        @endif
      </td>

      <td style="text-align: center;" class="act-on">
        <a href="{{route('testCase.edit', [$id, $testCase->id])}}"  class="btn modalLinkNew btn-xs icon-btn md-btn-flat"  style="margin-left: 23px; padding: 2px;margin-top: 0px;" data-modal-size="modal-xl" data-title="Edit Test Case"><span class="far fa-edit d-block"></span>
        </a>

         <!-- <a href="{{route('testCase.create', [$id, $testSheetID])}}" class="btn btn-primary btn-sm pull-right modalLinkNew dtb_custom_btn_default" style="margin-bottom: 20px;" data-modal-size="modal-xl" data-title="Add New Test Case">Add New Test Case</a> -->


        <a href="{{route('testcasecopystore', [$id, $testCase->id])}}"  class="btn btn-xs icon-btn md-btn-flat"  style="margin-left: 23px; padding: 2px;margin-top: 0px;"><span class="far fa-copy d-block"></span>
        </a>
      </td>
      <style>
        td.act-on {
          padding: 8px !important;
          margin: 0;
        }
        td.act-on a {
          /* float: left; */
          font-size: 15px;
          margin: 0 !important;
          /* padding: 0 !important; */
        }
        td.act-on a .fa-copy:before {
          content: "\f0c5";
          font-size: 17px;
          margin-left: 3px;
          /* margin-top: 0px; */
          float: left;
        }
      </style>
    </tr>
    @endforeach
    @endif

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
</div>
<div class="col-lg-1"></div>
</div>



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
  <script src="{{asset('/assets/js/marked.min.js')}}"></script>


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


    ///////// Test case  LIST DRAG DROP SORTING ///////////////////////
    $( "#tcaseordering" ).sortable({
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
          //alert(JSON.stringify(order, null, 4));exit();
        });
      $.ajax({
        url: {{$testSheetID}}+'/testcaseordering',
        type: 'PUT',
        data: {
          order:order,
          _token: '{{csrf_token()}}'
        },
        success: function(response){
            //alert(response);exit();
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
