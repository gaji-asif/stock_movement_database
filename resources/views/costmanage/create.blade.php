@extends('master_main')
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
form#costaddform input {
    border-radius: 0px;
    font-size: 13px;
}

form#costaddform input {
    margin-bottom: 15px;
}
form#costaddform select {
    margin-bottom: 15px;
}
</style>
<div class="row mt-4">
  <div class="col-lg-10 issue_wrapper">
<!--     <h4 class="font-weight-bold py-3 mb-4">
      <span class="text-muted font-weight-light">Dashboard /</span> Apps
    </h4> -->
    <div class="mb-4">
  

      <div class="card-body gap">
    <h4 class="px-4 mt-2" style="color: black">
        Add Cost
         <a href="{{ route('manageinvoices') }}" class="btn btn-primary btn-sm pull-right dtb_custom_btn_default" style="margin-top: -1px">All Cost</a>
    </h4>
    <hr class="mb-0">
  {!! Form::open(['route' => ['addcost'], 'method' => 'POST','files' => true, 'enctype' => 'multipart/form-data','id' => 'costaddform','class' => 'form-horizontal'])!!}



                        <div class="modal-body">
                            <div class="errmsg alert alert-danger" style="display:none">
                                <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>
                            @php
                                $developer_id = Session::get('developer_id');
                            @endphp
                            <input type="hidden" name="developer_id" value="{{ $developer_id }}">
                            <div class="form-row">
                                <div class="form-group col mb-0">
                                    <label class="form-label">Projects</label>
                                    
                                        <select required id="project_id" name="project_id" class="custom-select {{ $errors->has('project_id') ? ' is-invalid' : '' }}" >
                                          <option value="">Select Project</option>
                                          @foreach($projects as $project)
                                          <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                                          @endforeach
                                        </select>
                                </div>

                                <div class="form-group col mb-0">
                                    <label class="form-label">Apps</label>
                                       <select id="app_id" name="app_id" class="custom-select {{ $errors->has('app_id') ? ' is-invalid' : '' }}">
                                        <option>Select App</option>
                                        </select>
                                </div>
                            </div>


                            <div class="form-row">
                                <div class="form-group col mb-0">
                                    <label class="form-label">User</label>
                                    
                                        <select id="user_id" name="user_id" class="custom-select {{ $errors->has('user_id') ? ' is-invalid' : '' }}">
                                          <option value="">Select User</option>
                                          @foreach($users as $user)
                                          <option value="{{ $user->id }}">{{ $user->name }}</option>
                                          @endforeach
                                        </select>
                                </div>

                                <div class="form-group col mb-0">
                                    <label class="form-label">Work Time</label>
                                    <input  type="text" id="worktime" name="work_time" value="" class="summable form-control required" placeholder="">
                                </div>

                            </div>


                           <div class="form-row">
                                <div class="form-group col mb-0">
                                    <label class="form-label">Sub Total</label>
                                    <input type="number" id="subtotal" name="sub_total" value="" class="summable form-control required" placeholder="">
                                </div>
                                <div class="form-group col mb-0">
                                    <label class="form-label">Tax</label>
                                    <input type="number" id="tax" name="tax" value="" class="summable form-control required" placeholder="">
                                </div>
                            </div>



                           <div class="form-row">
                                <div class="form-group col mb-0">
                                    <label class="form-label">Billing Date</label>
                                    <input type="date" id="billingdate" name="billing_date" value="" class="form-control required" placeholder="">
                                </div>
                                <div class="form-group col mb-0">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer text-center">
                            <button type="submit" class="btn btn-primary btn-sm dtb_custom_btn_default m-auto px-5">Save</button>
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

$(document).ready(function() {


                    getprojectapp();
                    function getprojectapp(){

                        $('body').on('change','#project_id',function(e){

                            projectid = $(this).val();

                            $.ajax({
                            url: 'generateprojectapp',
                            type: 'GET',
                            data: {
                            projectid:projectid,
                            _token: '{{csrf_token()}}'
                            },
                            success: function(response){
                            if (response) {
                               //alert(response);exit();
                             $("#app_id").html(response);
                            
                            }
                            },
                            error: function() {
                            alert('Error occurs!');
                            }
                            });
                        });
                    }


});
</script>




@endsection
