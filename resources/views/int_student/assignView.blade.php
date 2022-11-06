@extends('master_main')
@section('mainContent')

<div class="container pt-5">
    <div class="row">

        <div class="col-lg-3">
            @include('settings.developerSettings.developer_settings_sidebar')
        </div>

        <div class="col-lg-9  settgs_right_content">
            <div class="card mb-4 no_border">

                <div class="card-body">
                    <h6 class="card_body_header">Students Assigned To {{ $Admission_officer_name }}

                    </h6>
                    <div class="card no_border">
                        <div class="table-responsive">
                            <table class="datatables-demo table table-striped table-bordered dtb_custom_tbl_common">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>E-mail</th>
                                        <th>Passport No</th>
                                        <th>Subject Intersted in</th>
                                        <th>Phone</th>
                                        <th>Country</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @include('int_student.allStudents')
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer border-0 text-right mb-2 pr-0">
                            <a href="{{route('assign')}}" class="btn btn-danger mr-2">{{ __('Return') }}</a>
                        </div>


                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
