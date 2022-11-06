@extends('master_main')
@section('mainContent')

@php
    if(Session::get('role') == '3'){
        $heading = 'My Application';
        $common_array = array(
        'content_heading' => 'My Application'
        );

        if(!empty($IntStudents)){
            foreach ($IntStudents as $IntStudent ) {
                if($IntStudent->status == "1" || $IntStudent->status == "2"){
                    $apply_route = 'int_student.index';
                    $apply_text = 'Already applied';
                }
                else{
                    $apply_route = 'int_student.create';
                    $apply_text = 'Apply Now';
                    }
            }
        } else{
            $apply_route = 'int_student.create';
            $apply_text = 'Apply Now';
        }
     } else if(Session::get('role') == '1') {
            $common_array = array(
            'content_heading' => 'Assigned Students'
            );
            $heading = 'Assigned Students';
            $apply_route = 'int_student.create';
            $apply_text = 'Add Student';
        }
        else{
            $common_array = array(
            'content_heading' => 'International Student List'
            );
            $heading = 'International Student List';
            $apply_route = 'int_student.create';
            $apply_text = 'Add Student';
        }
@endphp




<div class="card-body">

    <div class="card no_border  p-4">

        <h6 class="card_body_header pl-0">{{ $heading }}

            @if (Session::get('role') != '1' )
            <a href="{{route($apply_route)}}"><button
                    class="pull-right btn btn-success btn-sm dtb_custom_btn_default ">{{ $apply_text }}</button></a>
            @endif
        </h6>

        <!-- Filters -->
        {{-- @if(request()->is('report'))
                    <form id="search-students" method="post" action="javascript:void(0)">
                     {{csrf_field()}}
        <!-- Filters -->
        <div class=" pl-2">

            <div class="form-row ">
                <div class=" mr-4">
                    <label class="form-label">Status</label>
                    <select class="custom-select" name="status">
                        <option value="">Select Status</option>
                        <option value="1">Pending</option>
                        <option value="2">Submitted</option>
                        <option value="3">Offer Issued</option>
                        <option value="4">Visa Received</option>
                    </select>
                </div>
                <div class=" mr-4">
                    <label class="form-label">Intake</label>
                    <select class="custom-select" name="intake">
                        <option value="">Select Intake</option>
                        <option value="January 21">January 21</option>
                        <option value="April 21">April 21</option>
                        <option value="September 21">September 21</option>
                    </select>
                </div>
                <div class=" mr-4">
                    <label class="form-label">University</label>
                    <select class="custom-select" name="university">
                        @if(isset($university_list))
                        <option value="">Select University</option>
                        @foreach($university_list as $list)
                        <option value="{{$list->university}}">{{$list->university}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-xl-2 mb-4 pt-4">
                    <button id="search" type="submit" class="btn btn-success dtb_custom_btn_default">Search</button>
                </div>

            </div>

        </div>
        <div class="col-lg-12 text-center loader_class" style="display: none;">
            <img class="img-responsive" src="{{asset('assets_/img/loader.gif')}}" height="80" width="80">
        </div>
        {{ Form::close()}}
        </form>


        @endif --}}
        {{-- end of filters --}}

        <div class="table-responsive">
            <table class="datatables-int_student table table-striped table-bordered dtb_custom_tbl_common text-center ">
                <thead>
                    <tr>
                        {{-- @if ((request()->is('report'))) <th>Student Id</th> @endif --}}
                        <th> Name </th>

                        <th>E-mail</th>
                        <th>Passport No</th>
                        <th>Subject Intersted in</th>
                        <th>Phone</th>

                        <th> Country </th>

                        @if ( Session::get('role') == '0' )
                        <th>Admission Office</th>
                        <th>Agent</th>
                        @endif

                        {{-- @if ((request()->is('report'))) <th>Application Date</th> @endif --}}
                        {{-- @if ((request()->is('report'))) <th>Course Title</th> @endif --}}

                        <th>Status</th>

                        {{-- @if ((request()->is('report'))) <th>University</th> @endif --}}
                        {{-- @if ((request()->is('report'))) <th>Intake</th> @endif --}}

                        {{-- @if ((request()->is('report'))) <th>Date Decision Made</th> @endif --}}

                        <th>Action</th>

                    </tr>
                </thead>

                {{-- @if ((request()->is('int_student')))  --}}
                <tbody>
                    @include('int_student.allStudents')
                </tbody>
                {{-- @else  --}}
                {{-- <tbody id="allUserstbody">
                    @include('int_student.allStudentsreport')
                </tbody> --}}
                {{-- @endif --}}


            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.datatables-int_student').DataTable({
            "order": [
                [0, "desc"]
            ],
        });
    });
</script>





</div>
</div>
</div>
</div>
@endsection
