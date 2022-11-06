@extends('master_main')
@section('mainContent')


        
        @php
        $common_array = array(
        'content_heading' => 'Reports'
        );
        $heading = 'Reports';
        // $apply_route = 'int_student.create';
        // $apply_text = 'Add Student';
        @endphp

        



<div class="card-body">

    <div class="card no_border  p-4">

        <h6 class="card_body_header pl-0">{{ $heading }}

            {{-- @if (Session::get('role') != '1' && request()->is('int_student'))
            <a href="{{route($apply_route)}}"><button
                    class="pull-right btn btn-success btn-sm dtb_custom_btn_default ">{{ $apply_text }}</button></a>
            @endif --}}
        </h6>

        <!-- Filters -->
                    <form id="search-students" method="post" action="javascript:void(0)">
                     {{csrf_field()}}
					<div class=" pl-2">

						<div class="form-row ">
							<div class=" mr-4">
								<label class="form-label">Status</label>
								<select class="custom-select" name="status" >
									<option value="">Select Status</option>
									<option value="1">Pending</option>
									<option value="2">Submitted</option>
									<option value="3">Offer Issued</option>
									<option value="4">Visa Received</option>
								</select>
							</div>
							 <div class=" mr-4" >
								<label class="form-label">Intake</label>
								<select class="custom-select" name="intake">
									<option value="">Select Intake</option>
                                    <option value="January"{{ (old("month") == "January" ? "selected" : "" ) }}>January</option>
                                    <option value="February"{{ (old("month") == "February" ? "selected" : "" ) }}>February</option>
                                    <option value="March" {{ (old("month") == "March" ? "selected" : "" ) }}>March</option>
                                    <option value="April" {{ (old("month") == "April" ? "selected" : "" ) }}>April</option>
                                    <option value="May" {{ (old("month") == "May" ? "selected" : "" ) }}>May</option>
                                    <option value="June"{{ (old("month") == "June" ? "selected" : "" ) }}>June</option>
                                    <option value="July" {{ (old("month") == "July" ? "selected" : "" ) }}>July</option>
                                    <option value="August" {{ (old("month") == "August" ? "selected" : "" ) }}>August</option>
                                    <option value="Septembar" {{ (old("month") == "Septembar" ? "selected" : "" ) }}>Septembar</option>
                                    <option value="Octobar" {{ (old("month") == "Octobar" ? "selected" : "" ) }}>Octobar</option>
                                    <option value="Novembar" {{ (old("month") == "Novembar" ? "selected" : "" ) }}>Novembar</option>
                                    <option value="Decembar" {{ (old("month") == "Decembar" ? "selected" : "" ) }}>Decembar</option>
								</select>
							</div> 
                            <div class=" mr-4" >
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
                </form>
        {{-- end of filters --}}

        <div class="table-responsive">
            <table class="datatables-student_report table table-striped table-bordered dtb_custom_tbl_common text-center ">
                <thead>
                    <tr>
                        <th>Student Id</th>
                        <th>Applicant Name </th>
                        <th>Nationality</th>
                        <th>Application Date</th>
                        <th>Course Title</th>
                        <th>Status</th>
                        <th>University</th>
                        <th>Intake</th>
                        <th>Admission Date</th>
                    </tr>
                </thead>
                 
                    <tbody id="allUserstbody">
                    @include('int_student.report.allStudentsreport')
                    </tbody>
                   
                   
                
            </table>
        </div>
    </div>
</div>

</div>
</div>
</div>
</div>

<script>
    $(document).ready(function(){
        $('.datatables-student_report').dataTable({
            dom: 'Bfrtip',
            buttons: [
               'csvHtml5'
            ]
        });
    });
</script>


@endsection



<script src="{{asset('assets/js/jquery.js')}}"></script>


<script>
$(document).on('submit', '#search-students', function () {
        $('.loader_class').show();
        form_data = $("#search-students").serialize();
        url = 'search-students';
        $.ajax({
            type: "post",
            url: url,
            data: form_data,
            cache: false,
            success: function (data) {
                $('.loader_class').hide();
                console.log(data);
            $("#allUserstbody").empty();
            $("#allUserstbody").html(data);
            }
        });

    });
</script>